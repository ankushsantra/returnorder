<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Ankush\Returnorder\Block\Adminhtml\Quotation\Renderer;

use Magento\Framework\ObjectManagerInterface;

class ReturnProduct extends \Magento\Framework\Data\Form\Element\AbstractElement
{
    protected $objectManager;
    public function __construct(ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }
   
    public function getElementHtml()
    {
        return $this->getValue();
    }
}