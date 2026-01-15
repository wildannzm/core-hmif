<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add indexes to events table for performance and security (skip if exists)
        Schema::table('events', function (Blueprint $table) {
            // These indexes might already exist from previous migrations
            $indexes = DB::select("SHOW INDEX FROM events WHERE Key_name = 'idx_events_slug'");
            if (empty($indexes)) {
                $table->index('slug', 'idx_events_slug');
            }
            
            $indexes = DB::select("SHOW INDEX FROM events WHERE Key_name = 'idx_events_is_active'");
            if (empty($indexes)) {
                $table->index('is_active', 'idx_events_is_active');
            }
            
            $indexes = DB::select("SHOW INDEX FROM events WHERE Key_name = 'idx_events_booking_period'");
            if (empty($indexes)) {
                $table->index(['start_date', 'end_date'], 'idx_events_booking_period');
            }
            
            $indexes = DB::select("SHOW INDEX FROM events WHERE Key_name = 'idx_events_event_period'");
            if (empty($indexes)) {
                $table->index(['event_start_date', 'event_end_date'], 'idx_events_event_period');
            }
            
            $indexes = DB::select("SHOW INDEX FROM events WHERE Key_name = 'idx_events_available_quota'");
            if (empty($indexes)) {
                $table->index('available_quota', 'idx_events_available_quota');
            }
        });

        // Add indexes to event_orders table for performance
        Schema::table('event_orders', function (Blueprint $table) {
            $indexes = DB::select("SHOW INDEX FROM event_orders WHERE Key_name = 'idx_event_orders_invoice'");
            if (empty($indexes)) {
                $table->index('invoice_code', 'idx_event_orders_invoice');
            }
            
            $indexes = DB::select("SHOW INDEX FROM event_orders WHERE Key_name = 'idx_event_orders_status'");
            if (empty($indexes)) {
                $table->index('status', 'idx_event_orders_status');
            }
            
            $indexes = DB::select("SHOW INDEX FROM event_orders WHERE Key_name = 'idx_event_orders_event_status'");
            if (empty($indexes)) {
                $table->index(['event_id', 'status'], 'idx_event_orders_event_status');
            }
            
            $indexes = DB::select("SHOW INDEX FROM event_orders WHERE Key_name = 'idx_event_orders_buyer_email'");
            if (empty($indexes)) {
                $table->index('buyer_email', 'idx_event_orders_buyer_email');
            }
            
            $indexes = DB::select("SHOW INDEX FROM event_orders WHERE Key_name = 'idx_event_orders_created_at'");
            if (empty($indexes)) {
                $table->index('created_at', 'idx_event_orders_created_at');
            }
        });

        // Add indexes to event_attendees table for check-in performance
        Schema::table('event_attendees', function (Blueprint $table) {
            // Check for unique ticket_code
            $indexes = DB::select("SHOW INDEX FROM event_attendees WHERE Key_name = 'uniq_event_attendees_ticket_code'");
            if (empty($indexes)) {
                try {
                    $table->unique('ticket_code', 'uniq_event_attendees_ticket_code');
                } catch (\Exception $e) {
                    // Skip if already exists
                }
            }
            
            $indexes = DB::select("SHOW INDEX FROM event_attendees WHERE Key_name = 'idx_event_attendees_checked_in'");
            if (empty($indexes)) {
                $table->index('is_checked_in', 'idx_event_attendees_checked_in');
            }
            
            $indexes = DB::select("SHOW INDEX FROM event_attendees WHERE Key_name = 'idx_event_attendees_order_checked'");
            if (empty($indexes)) {
                $table->index(['event_order_id', 'is_checked_in'], 'idx_event_attendees_order_checked');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop indexes from events table
        Schema::table('events', function (Blueprint $table) {
            $table->dropIndex('idx_events_slug');
            $table->dropIndex('idx_events_is_active');
            $table->dropIndex('idx_events_booking_period');
            $table->dropIndex('idx_events_event_period');
            $table->dropIndex('idx_events_available_quota');
        });

        // Drop indexes from event_orders table
        Schema::table('event_orders', function (Blueprint $table) {
            $table->dropIndex('idx_event_orders_invoice');
            $table->dropIndex('idx_event_orders_status');
            $table->dropIndex('idx_event_orders_event_status');
            $table->dropIndex('idx_event_orders_buyer_email');
            $table->dropIndex('idx_event_orders_created_at');
        });

        // Drop indexes from event_attendees table
        Schema::table('event_attendees', function (Blueprint $table) {
            $table->dropUnique('uniq_event_attendees_ticket_code');
            $table->dropIndex('idx_event_attendees_checked_in');
            $table->dropIndex('idx_event_attendees_order_checked');
        });
    }
};
