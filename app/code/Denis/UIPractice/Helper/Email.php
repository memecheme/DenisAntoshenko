<?php
namespace Denis\UIPractice\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\Escaper;
use Magento\Framework\Mail\Template\TransportBuilder;

class Email extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $inlineTranslation;
    protected $escaper;
    protected $transportBuilder;
    protected $logger;

    public function __construct(
        Context $context,
        StateInterface $inlineTranslation,
        Escaper $escaper,
        TransportBuilder $transportBuilder
    ) {
        parent::__construct($context);
        $this->inlineTranslation = $inlineTranslation;
        $this->escaper = $escaper;
        $this->transportBuilder = $transportBuilder;
        $this->logger = $context->getLogger();
    }

    public function sendEmail($scName, $scID, $scDate, $scEmail, $scComment, $scAnswer)
    {
        try {
            $this->inlineTranslation->suspend();
            $sender = [
                'name' => $this->escaper->escapeHtml('Perspective Studio'),
                'email' => $this->escaper->escapeHtml('perspectivestudio@gmail.com'),
            ];
            $transport = $this->transportBuilder
                ->setTemplateIdentifier('email_sc_template')
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                    ]
                )
                ->setTemplateVars([
                    'scName'  => $scName,
                    'scID'  => $scID,
                    'scDate'  => $scDate,
                    'scComment'  => $scComment,
                    'scAnswer'  => $scAnswer,
                    'answerDate'  => date("Y-m-d")
                ])
                ->setFrom($sender)
                ->addTo($scEmail)
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (\Exception $e) {
            $this->logger->debug($e->getMessage());
        }
    }
}
