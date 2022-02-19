<?php
namespace Denis\TestTaskThree\Block;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Registry;
use Magento\CatalogRule\Model\Rule;

class ExpirationDate extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Registry
     */
    protected $_registry;

    /**
     * @var Rule
     */
    protected $_rule;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param Rule $rule
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        Rule $rule,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_registry = $registry;
        $this->_rule = $rule;
    }

    /**
     * @return mixed|null
     */
    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }

    /**
     * @return string|null
     */
    public function getSpecialDate()
    {
        $endSpecialDate = $this->getCurrentProduct()->getSpecialToDate();
        if ($endSpecialDate) {
            $date = date_create($endSpecialDate);
            return date_format($date, 'Y-m-d');
        } else {
            return null;
        }
    }

    /**
     * @param int $ruleId
     * @return string|void|null
     * @throws LocalizedException
     */
    public function getRuleDate(int $ruleId)
    {
        $rules = $this->_rule->getResourceCollection()->addFieldToFilter('rule_id', $ruleId);
        $productId = $this->getCurrentProduct()->getId();
        if ($rules) {
            foreach ($rules as $rule) {
                if (isset($rule->getMatchingProductIds()[$productId][1])) {
                    $data = date_create($rule->getToDate());
                    return date_format($data, 'Y-m-d');
                } else {
                    return null;
                }
            }
        } else {
            return null;
        }
    }

    /**
     * @param int $ruleId_one
     * @param int $ruleId_two
     * @return string|void|null
     * @throws LocalizedException
     */
    public function getNearestCatalogRuleDate(int $ruleId_one, int $ruleId_two)
    {
        if ($this->getRuleDate($ruleId_one) >= $this->getRuleDate($ruleId_two)) {
            return $this->getRuleDate($ruleId_two);
        } else {
            return $this->getRuleDate($ruleId_one);
        }
    }

    /**
     * @param string $ruleId
     * @return string|null
     */
    public function getNearestDate(string $ruleId)
    {
        if ($this->getSpecialDate() >= $ruleId) {
            return $ruleId;
        } else {
            return $this->getSpecialDate();
        }
    }
}
