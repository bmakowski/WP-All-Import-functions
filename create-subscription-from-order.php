<?php

add_action('pmxi_saved_post', 'create_subscription_from_order', 10, 1);

function create_subscription_from_order($id) {

    $order = wc_get_order($id);
    if (!empty($order)) {
        $product_id = 0;
        foreach ($order->get_items() as $line_item) {
            $product_id = $line_item['product_id'];
        }
        WC_Subscriptions_Manager::create_pending_subscription_for_order($id, $product_id);
        foreach (wcs_get_subscriptions_for_order($id, array('order_type' => 'parent')) as $subscription_id => $subscription) {
            $subscription->update_status('active');
        }
    }
}
