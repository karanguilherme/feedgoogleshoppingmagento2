<?php

namespace VertexNet\GoogleShopping\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * XmlFeed Model
     *
     * @var \VertexNet\GoogleShopping\Model\Xmlfeed
     */
    protected $xmlFeed;

    /**
     * General Helper
     *
     * @var \VertexNet\GoogleShopping\Helper\Data
     */
    private $helper;

    /**
     * Result Forward Factory
     *
     * @var \VertexNet\GoogleShopping\Helper\Data
     */
    private $resultForward;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \VertexNet\GoogleShopping\Model\Xmlfeed $xmlFeed,
        \VertexNet\GoogleShopping\Helper\Data $helper,
        \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory
    ) {
        $this->xmlFeed = $xmlFeed;
        $this->helper = $helper;
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }
    
    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();

        if (!empty($this->helper->getConfig('enabled'))) {
            echo $this->xmlFeed->getFeed();
        } else {
            $resultForward->forward('noroute');
        }
    }
}