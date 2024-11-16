<?php

namespace App\Enums;

class ProductStatusEnums
{
    public const Draft = 'draft';
    public const Published = 'published';
    public const Unpublished = 'unpublished';
    public const OutOfStock = 'out_of_stock';
    public const Archived = 'archived';
    public const PendingReview = 'pending_review';
    public const ComingSoon = 'coming_soon';
    public const PreOrder = 'pre_order';
    public const Backordered = 'backordered';
    public const Discontinued = 'discontinued';

    public static function getValues()
    {
        return [
            self::Draft => 'Draft',
            self::Published => 'Published',
            self::Unpublished => 'Unpublished',
            self::OutOfStock => 'Out of Stock',
            self::Archived => 'Archived',
            self::PendingReview => 'Pending Review',
            self::ComingSoon => 'Coming Soon',
            self::PreOrder => 'Pre-Order',
            self::Backordered => 'Backordered',
            self::Discontinued => 'Discontinued',
        ];
    }
}
