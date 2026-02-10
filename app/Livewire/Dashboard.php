<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Schedule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Dashboard')]
#[Layout('components.layouts.app')]
class Dashboard extends Component
{
    public $selectedDate;

    public function mount()
    {
        Carbon::setLocale('id');
        $this->selectedDate = Carbon::now()->format('Y-m-d');
    }

    public function getCalendarProperty()
    {
        $date = Carbon::parse($this->selectedDate);
        $startOfMonth = $date->copy()->startOfMonth();
        $endOfMonth = $date->copy()->endOfMonth();

        $startOfWeek = $startOfMonth->copy()->startOfWeek();
        $endOfWeek = $endOfMonth->copy()->endOfWeek();

        $calendar = [];
        $currentDate = $startOfWeek->copy();

        while ($currentDate->lte($endOfWeek)) {
            $calendar[] = $currentDate->copy();
            $currentDate->addDay();
        }

        return collect($calendar)->chunk(7);
    }

    public function getMonthEventsProperty()
    {
        $date = Carbon::parse($this->selectedDate);

        $schedules = Schedule::whereYear('date', $date->year)
            ->whereMonth('date', $date->month)
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();

        // Fetch Holidays from Google Calendar (ICS)
        $holidays = \Illuminate\Support\Facades\Cache::remember('holidays_google_id', 86400, function () {
            try {
                $icsUrl = 'https://calendar.google.com/calendar/ical/id.indonesian%23holiday%40group.v.calendar.google.com/public/basic.ics';
                $icsContent = \Illuminate\Support\Facades\Http::get($icsUrl)->body();

                // Simple ICS Parser
                $events = [];
                $lines = explode("\n", $icsContent);
                $currentEvent = [];
                $inEvent = false;

                foreach ($lines as $line) {
                    $line = trim($line);
                    if ($line === 'BEGIN:VEVENT') {
                        $inEvent = true;
                        $currentEvent = [];
                        continue;
                    }
                    if ($line === 'END:VEVENT') {
                        $inEvent = false;
                        if (isset($currentEvent['DTSTART']) && isset($currentEvent['SUMMARY'])) {
                            // Parse Date (YYYYMMDD)
                            $dateStr = $currentEvent['DTSTART'];
                            if (preg_match('/(\d{8})/', $dateStr, $matches)) {
                                $events[] = [
                                    'date' => Carbon::createFromFormat('Ymd', $matches[1])->format('Y-m-d'),
                                    'name' => $currentEvent['SUMMARY'],
                                ];
                            }
                        }
                        continue;
                    }
                    if ($inEvent) {
                        if (str_starts_with($line, 'DTSTART')) {
                            $currentEvent['DTSTART'] = $line;
                        } elseif (str_starts_with($line, 'SUMMARY:')) {
                            $currentEvent['SUMMARY'] = substr($line, 8);
                        }
                    }
                }

                return $events;
            } catch (\Exception $e) {
                return [];
            }
        });

        $monthHolidays = collect($holidays)->filter(function ($holiday) use ($date) {
            return Carbon::parse($holiday['date'])->month === $date->month &&
                   Carbon::parse($holiday['date'])->year === $date->year;
        })->map(function ($holiday) {
            return (object) [
                'id' => 'holiday-' . $holiday['date'],
                'name' => $holiday['name'],
                'description' => 'Hari Libur Nasional',
                'date' => $holiday['date'],
                'start_time' => null,
                'is_holiday' => true,
            ];
        });

        // Merge and sort
        return $schedules->toBase()->merge($monthHolidays)
            ->sortBy([
                ['is_holiday', 'asc'],
                ['date', 'asc'],
                ['start_time', 'asc'],
            ])
            ->groupBy(function($schedule) {
                return Carbon::parse($schedule->date)->format('Y-m-d');
            });
    }

    public function getSelectedDateEventsProperty()
    {
        return Schedule::whereDate('date', $this->selectedDate)
            ->orderBy('start_time')
            ->get();
    }

    public function selectDate($date)
    {
        $this->selectedDate = $date;
    }

    public function nextMonth()
    {
        $this->selectedDate = Carbon::parse($this->selectedDate)->addMonth()->startOfMonth()->format('Y-m-d');
    }

    public function previousMonth()
    {
        $this->selectedDate = Carbon::parse($this->selectedDate)->subMonth()->startOfMonth()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'calendar' => $this->calendar,
            'monthEvents' => $this->monthEvents,
            'selectedDateEvents' => $this->selectedDateEvents,
            'currentMonth' => Carbon::parse($this->selectedDate)->translatedFormat('F Y'),
        ]);
    }
}
