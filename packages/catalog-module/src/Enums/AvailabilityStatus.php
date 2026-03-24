<?php

namespace Module1\CatalogModule\Enums;

/**
 * Defines the availability states for catalog items.
 */
enum AvailabilityStatus: string
{
    case Inactive = 'inactive';
    case Active = 'active';
    case ComingSoon = 'coming_soon';
    case LeavingSoon = 'leaving_soon';

    /**
     * Return the available status values for validation rules.
     *
     * @return array<int, string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Human-readable label for UI output.
     */
    public function label(): string
    {
        return match ($this) {
            self::Inactive => 'Inactive',
            self::Active => 'Active',
            self::ComingSoon => 'Coming soon',
            self::LeavingSoon => 'Leaving soon',
        };
    }
}