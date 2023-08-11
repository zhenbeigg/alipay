<?php
/*
 * @author: 布尔
 * @name:  请求客户端
 * @desc: 介绍
 * @LastEditTime: 2023-04-13 16:29:44
 * @FilePath: \eyc3_auth\Eykj\Alipay\Service.php
 */
namespace Eykj\Alipay;

use Eykj\Alipay\aop\AopCertClient as Aop;

class AopClient
{
    private Aop $Aop;

    // 通过设置参数为 nullable，表明该参数为一个可选参数
    public function __construct(Aop $Aop)
    {
        $this->Aop = $Aop;
    }
    /**
     * @author: 布尔
     * @name: 获取证书请求类客户端
     * @return {*}
     */    
    public function get_aop_cert_client(array $param=[]):object
    {
        $this->Aop->appId = isset($param['app_id'])?$param['app_id']:get_config('pay.alipay.default.app_id');
        $this->Aop->rsaPrivateKey = isset($param['app_secret_cert'])?$param['app_secret_cert']:get_config('pay.alipay.default.app_secret_cert');
        $this->Aop->alipayrsaPublicKey=  isset($param['alipay_public_cert_path'])?$param['alipay_public_cert_path']:$this->Aop->getPublicKey(get_config('pay.alipay.default.alipay_public_cert_path'));
        $this->Aop->appCertSN =  isset($param['app_public_cert_path'])?$param['app_public_cert_path']:$this->Aop->getCertSN(get_config('pay.alipay.default.app_public_cert_path'));//调用getCertSN获取证书序列号
        $this->Aop->alipayRootCertSN =  isset($param['alipay_root_cert_path'])?$param['alipay_root_cert_path']:$this->Aop->getRootCertSN(get_config('pay.alipay.default.alipay_root_cert_path'));//调用getRootCertSN获取支付宝根证书序列号
        $this->Aop->signType = 'RSA2';
        return $this->Aop;
    }
}