<?php
/**
 * 2007-2020 PrestaShop and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2020 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

namespace PrestaShop\Module\PrestashopCheckout\Api\Payment;

use PrestaShop\Module\PrestashopCheckout\Api\Payment\Client\PaymentClient;

/**
 * Handle Webhook requests
 */
class Webhook extends PaymentClient
{
    /**
     * Tells if the webhook came from the PSL
     *
     * @param array $payload
     *
     * @return array
     */
    public function getShopSignature(array $payload)
    {
        $this->setRoute('/payments/shop/verify_webhook_signature');

        return $this->post([
            'json' => $payload,
        ]);
    }

    /**
     * Tells if the webhook contains the proper MerchantId
     *
     * @param array $payload
     *
     * @return array
     */
    public function getShopMerchantID(array $payload)
    {
        // TODO : update this with proper merchant ID route check ?
        $this->setRoute('/payments/shop/verify_webhook_signature');

        return $this->post([
            'json' => $payload,
        ]);
    }
}
