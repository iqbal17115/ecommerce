<?php 
namespace App\Enums;

class ProductCancelReasonEnum
{
    public const WRONG_ITEM_RECEIVED = 'wrong_item_received';
    public const DEFECTIVE_OR_DAMAGED = 'defective_or_damaged';
    public const SIZE_COLOR_MISMATCH = 'size_color_mismatch';
    public const QUALITY_CONCERNS = 'quality_concerns';
    public const CHANGE_OF_MIND = 'change_of_mind';
    public const DOESNT_MEET_EXPECTATIONS = 'doesnt_meet_expectations';
    public const EXPIRED_OR_SHORT_SHELF_LIFE = 'expired_or_short_shelf_life';
    public const RECEIVED_EXTRA_ITEMS = 'received_extra_items';
    public const LATE_DELIVERY = 'late_delivery';
    public const INCOMPLETE_ORDER = 'incomplete_order';
    public const PRODUCT_NOT_AS_DESCRIBED = 'product_not_as_described';
    public const DAMAGED_DURING_SHIPPING = 'damaged_during_shipping';
    public const SIZE_ISSUES = 'size_issues';
    public const MISPLACED_ORDER = 'misplaced_order';
    public const TECHNICAL_COMPATIBILITY = 'technical_compatibility';
    public const ALLERGIC_REACTION = 'allergic_reaction';
    public const UNWANTED_GIFT = 'unwanted_gift';
    public const UNSATISFACTORY_PERFORMANCE = 'unsatisfactory_performance';
    public const CUSTOMER_FOUND_BETTER_OPTION = 'customer_found_better_option';

    public static function getCancelOptions()
    {
        return [
            self::WRONG_ITEM_RECEIVED => 'Wrong Item Received',
            self::DEFECTIVE_OR_DAMAGED => 'Defective or Damaged Item',
            self::SIZE_COLOR_MISMATCH => 'Size/Color Mismatch',
            self::QUALITY_CONCERNS => 'Quality Concerns',
            self::CHANGE_OF_MIND => 'Change of Mind',
            self::DOESNT_MEET_EXPECTATIONS => "Doesn't Meet Expectations",
            self::EXPIRED_OR_SHORT_SHELF_LIFE => 'Expired or Short Shelf Life',
            self::RECEIVED_EXTRA_ITEMS => 'Received Extra Items',
            self::LATE_DELIVERY => 'Late Delivery',
            self::INCOMPLETE_ORDER => 'Incomplete Order',
            self::PRODUCT_NOT_AS_DESCRIBED => 'Product Not as Described',
            self::DAMAGED_DURING_SHIPPING => 'Damaged During Shipping',
            self::SIZE_ISSUES => 'Size Issues',
            self::MISPLACED_ORDER => 'Misplaced Order',
            self::TECHNICAL_COMPATIBILITY => 'Technical Compatibility',
            self::ALLERGIC_REACTION => 'Allergic Reaction',
            self::UNWANTED_GIFT => 'Unwanted Gift',
            self::UNSATISFACTORY_PERFORMANCE => 'Unsatisfactory Performance',
            self::CUSTOMER_FOUND_BETTER_OPTION => 'Customer Found Better Option',
        ];
    }
}