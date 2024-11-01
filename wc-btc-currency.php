<?php
/**
 * Plugin Name: WooCommerce BTC Currency
 * Plugin URI: http://claudiosmweb.com/
 * Description: Adds Bitcoin currency in WooCommerce
 * Author: claudiosanches
 * Author URI: http://www.claudiosmweb.com/
 * Version: 2.0
 * License: GPLv2 or later
 */

if ( ! class_exists( 'WC_BTC_Currency' ) ) {

    /**
     * Add BTC Currency in WooCommerce.
     */
    class WC_BTC_Currency {

        /**
         * Class construct.
         */
        public function __construct() {

            // Actions.
            add_action( 'plugins_loaded', array( &$this, 'load_textdomain' ), 0 );

            // Filters.
            add_filter( 'woocommerce_currencies', array( &$this, 'add_currency' ) );
            add_filter( 'woocommerce_currency_symbol', array( &$this, 'currency_symbol' ), 1, 2 );
        }

        /**
         * Load Plugin textdomain.
         *
         * @return void.
         */
        public function load_textdomain() {
            load_plugin_textdomain( 'wcbtc', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
        }

        /**
         * Add BTC Currency in WooCommerce.
         *
         * @param  array $currencies Current currencies.
         *
         * @return array             Currencies with BTC.
         */
        public function add_currency( $currencies ) {
            $currencies['BTC'] = __( 'Bitcoin', 'wcbtc' );
            asort( $currencies );

            return $currencies;
        }

        /**
         * Add BTC Symbol
         *
         * @param  string $currency_symbol Currency symbol.
         * @param  array  $currency        Current currencies.
         *
         * @return string                  BTC currency symbol.
         */
        public function currency_symbol( $currency_symbol, $currency ) {
            switch( $currency ) {
                case 'BTC':
                    $currency_symbol = '&#3647;';
                    break;
            }

            return $currency_symbol;
        }

    } // close WC_BTC_Currency class.

    $WC_BTC_Currency = new WC_BTC_Currency();
}
