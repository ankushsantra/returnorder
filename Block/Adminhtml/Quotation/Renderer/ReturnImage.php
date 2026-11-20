<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Ankush\Returnorder\Block\Adminhtml\Quotation\Renderer;

use Magento\Framework\ObjectManagerInterface;

class ReturnImage extends \Magento\Framework\Data\Form\Element\AbstractElement
{
    protected $objectManager;
    public function __construct(ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }
   
    public function getElementHtml()
    {
        $customDiv = '';
        if(!empty($this->getValue())) {
            $mediaDirectory = $this->objectManager->get('Magento\Store\Model\StoreManagerInterface')->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
            $imageUrl = $mediaDirectory.'returnImages/'.$this->getValue();
            $customDiv = '<img style="width:100%;" src="'.$imageUrl.'" />';
        }
        return $customDiv;
    }
}