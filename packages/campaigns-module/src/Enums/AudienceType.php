<?php

namespace Module2\CampaignsModule\Enums;

/**
 * Defines who a campaign is intended for.
 */
enum AudienceType: string
{
    case AllUsers = 'all_users';
    case SelectedUsers = 'selected_users';

    /**
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match ($this) {
            self::AllUsers => 'All users',
            self::SelectedUsers => 'Selected users',
        };
    }
}