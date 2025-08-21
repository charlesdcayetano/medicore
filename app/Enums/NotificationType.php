<?php
namespace App\Enums;

class NotificationType {
    public const Appointment = 'appointment';
    public const MedicineStock = 'medicine_stock';
    public const Billing = 'billing';
    public const System = 'system';
    public const General = 'general';

    public static function all(): array {
        return [
            self::Appointment,
            self::MedicineStock,
            self::Billing,
            self::System,
            self::General,
        ];
    }
}
