<?php
/**
 * Created by Hung Nguyen - hungnh@smartosc.com
 * Date: 24/10/2018
 * Time: 18:10
 */

namespace SM\PWAQrCode\Api\Data;


/**
 * Interface QrCodeInterface
 * @package SM\PWAQrCode\Api\Data
 */
interface QrCodeInterface
{
    const ID = 'qrcode_id';
    const TEXT = 'text';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getText();

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @return string
     */
    public function getUpdatedAt();

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * @param string $text
     * @return $this
     */
    public function setText($text);

    /**
     * @param string $date
     * @return $this
     */
    public function setCreatedAt($date);

    /**
     * @param string $date
     * @return $this
     */
    public function setUpdatedAt($date);
}
