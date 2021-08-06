<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Pending()
 * @method static static Disetujui()
 * @method static static Ditolak()
 */
final class ApprovalStatus extends Enum
{
    const Pending =     0;
    const Disetujui =   1;
    const Ditolak =     2;
}
