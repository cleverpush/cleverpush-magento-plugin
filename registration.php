<?php
/**
 * CleverPush module registration
 *
 * @category Registration
 * @package  CleverPush
 * @author   CleverPush GmbH <support@cleverpush.com>
 * @link     https://cleverpush.com
 */
\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE,
    'Cleverpush_WebPush',
    __DIR__
);
