<?php

// This file is auto-generated, don't edit it. Thanks.

namespace Alipay\EasySDK\Member\Identification;

use AlibabaCloud\Tea\Tea;
use AlibabaCloud\Tea\Request;
use AlibabaCloud\Tea\Exception\TeaError;
use AlibabaCloud\Tea\Exception\TeaUnableRetryError;
use Alipay\EasySDK\Kernel\BaseClient;

use Alipay\EasySDK\Member\Identification\Models\method;
use Alipay\EasySDK\Member\Identification\Models\IdentityParam;
use Alipay\EasySDK\Member\Identification\Models\MerchantConfig;

class Client extends BaseClient{
    protected $_name = [];

    private $_getConfig;

    private $_isCertMode;

    private $_getTimestamp;

    private $_sign;

    private $_getMerchantCertSN;

    private $_getAlipayRootCertSN;

    private $_toUrlEncodedRequestBody;

    private $_readAsJson;

    private $_getAlipayCertSN;

    private $_extractAlipayPublicKey;

    private $_verify;

    private $_toRespModel;

    private $_generatePage;

    private $_getSdkVersion;


    public function certify($certifyId){
        $systemParams = [
            "method" => "alipay.user.certify.open.certify",
            "app_id" => $this->_getConfig("appId"),
            "timestamp" => $this->_getTimestamp(),
            "format" => "json",
            "version" => "1.0",
            "alipay_sdk" => $this->_getSdkVersion(),
            "charset" => "UTF-8",
            "sign_type" => $this->_getConfig("signType"),
            "app_cert_sn" => $this->_getMerchantCertSN(),
            "alipay_root_cert_sn" => $this->_getAlipayRootCertSN()
        ];
        $bizParams = [
            "certify_id" => $certifyId
        ];
        $textParams = [];
        $sign = $this->_sign($systemParams, $bizParams, $textParams, $this->_getConfig("merchantPrivateKey"));
        $response = $this->_generatePage("GET", $systemParams, $bizParams, $textParams, $sign);
        return $response;
    }

    public function init($outerOrderNo, $bizCode, IdentityParam $identityParam, MerchantConfig $merchantConfig){
        $identityParam->validate();
        $merchantConfig->validate();
        $_runtime = [
            "connectTimeout" => 15000,
            "readTimeout" => 15000,
            "retry" => [
                "maxAttempts" => 0
            ]
        ];
        $_lastRequest = null;
        $_now = time();
        $_retryTimes = 0;
        while (Tea::allowRetry($_runtime["retry"], $_retryTimes, $_now)) {
            if ($_retryTimes > 0) {
                $_backoffTime = Tea::getBackoffTime($_runtime["backoff"], $_retryTimes);
                if ($_backoffTime > 0) {
                    Tea::sleep($_backoffTime);
                }
            }
            $_retryTimes = $_retryTimes + 1;
            try {
                $_request = new Request();
                $systemParams = [
                    "method" => "alipay.user.certify.open.initialize",
                    "app_id" => $this->_getConfig("appId"),
                    "timestamp" => $this->_getTimestamp(),
                    "format" => "json",
                    "version" => "1.0",
                    "alipay_sdk" => $this->_getSdkVersion(),
                    "charset" => "UTF-8",
                    "sign_type" => $this->_getConfig("signType"),
                    "app_cert_sn" => $this->_getMerchantCertSN(),
                    "alipay_root_cert_sn" => $this->_getAlipayRootCertSN()
                ];
                $bizParams = [
                    "outer_order_no" => $outerOrderNo,
                    "biz_code" => $bizCode,
                    "identity_param" => $identityParam,
                    "merchant_config" => $merchantConfig
                ];
                $textParams = [];
                $_request->protocol = $this->_getConfig("protocol");
                $_request->method = "POST";
                $_request->pathname = "/gateway.do";
                $_request->headers = [
                    "host" => $this->_getConfig("gatewayHost"),
                    "content-type" => "application/x-www-form-urlencoded;charset=utf-8"
                ];
                $_request->query = array_merge([
                    "sign" => $this->_sign($systemParams, $bizParams, $textParams, $this->_getConfig("merchantPrivateKey"))],
                    $systemParams);
                $_request->body = $this->_toUrlEncodedRequestBody($bizParams, $textParams);
                $_lastRequest = $_request;
                $_response= Tea::send($_request, $_runtime);
                $respMap = $this->_readAsJson($_response, "alipay.user.certify.open.initialize");
                if ($this->_isCertMode()) {
                    if ($this->_verify($respMap, $this->_extractAlipayPublicKey($this->_getAlipayCertSN($respMap)))) {
                        return $this->_toRespModel($respMap);
                    }
                }
                else {
                    if ($this->_verify($respMap, $this->_getConfig("alipayPublicKey"))) {
                        return $this->_toRespModel($respMap);
                    }
                }
                throw new TeaError([
                    "message" => "验签失败，请检查支付宝公钥设置是否正确。"
                ]);
            }
            catch (\Exception $e) {
                if (Tea::isRetryable($e)) {
                    continue;
                }
                throw $e;
            }
        }
        throw new TeaUnableRetryError($_lastRequest);
    }

    public function query($certifyId){
        $_runtime = [
            "connectTimeout" => 15000,
            "readTimeout" => 15000,
            "retry" => [
                "maxAttempts" => 0
            ]
        ];
        $_lastRequest = null;
        $_now = time();
        $_retryTimes = 0;
        while (Tea::allowRetry($_runtime["retry"], $_retryTimes, $_now)) {
            if ($_retryTimes > 0) {
                $_backoffTime = Tea::getBackoffTime($_runtime["backoff"], $_retryTimes);
                if ($_backoffTime > 0) {
                    Tea::sleep($_backoffTime);
                }
            }
            $_retryTimes = $_retryTimes + 1;
            try {
                $_request = new Request();
                $systemParams = [
                    "method" => "alipay.user.certify.open.query",
                    "app_id" => $this->_getConfig("appId"),
                    "timestamp" => $this->_getTimestamp(),
                    "format" => "json",
                    "version" => "1.0",
                    "alipay_sdk" => $this->_getSdkVersion(),
                    "charset" => "UTF-8",
                    "sign_type" => $this->_getConfig("signType"),
                    "app_cert_sn" => $this->_getMerchantCertSN(),
                    "alipay_root_cert_sn" => $this->_getAlipayRootCertSN()
                ];
                $bizParams = [
                    "certify_id" => $certifyId
                ];
                $textParams = [];
                $_request->protocol = $this->_getConfig("protocol");
                $_request->method = "POST";
                $_request->pathname = "/gateway.do";
                $_request->headers = [
                    "host" => $this->_getConfig("gatewayHost"),
                    "content-type" => "application/x-www-form-urlencoded;charset=utf-8"
                ];
                $_request->query = array_merge([
                    "sign" => $this->_sign($systemParams, $bizParams, $textParams, $this->_getConfig("merchantPrivateKey"))],
                    $systemParams);
                $_request->body = $this->_toUrlEncodedRequestBody($bizParams, $textParams);
                $_lastRequest = $_request;
                $_response= Tea::send($_request, $_runtime);
                $respMap = $this->_readAsJson($_response, "alipay.user.certify.open.query");
                if ($this->_isCertMode()) {
                    if ($this->_verify($respMap, $this->_extractAlipayPublicKey($this->_getAlipayCertSN($respMap)))) {
                        return $this->_toRespModel($respMap);
                    }
                }
                else {
                    if ($this->_verify($respMap, $this->_getConfig("alipayPublicKey"))) {
                        return $this->_toRespModel($respMap);
                    }
                }
                throw new TeaError([
                    "message" => "验签失败，请检查支付宝公钥设置是否正确。"
                ]);
            }
            catch (\Exception $e) {
                if (Tea::isRetryable($e)) {
                    continue;
                }
                throw $e;
            }
        }
        throw new TeaUnableRetryError($_lastRequest);
    }
}
