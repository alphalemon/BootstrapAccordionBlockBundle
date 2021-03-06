<?php
/*
 * This file is part of the BootstrapAccordionBlockBundle and it is distributed
 * under the MIT LICENSE. To use this application you must leave intact this copyright 
 * notice.
 *
 * Copyright (c) AlphaLemon <webmaster@alphalemon.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * For extra documentation and help please visit http://www.alphalemon.com
 * 
 * @license    MIT LICENSE
 * 
 */
 
namespace AlphaLemon\Block\BootstrapAccordionBlockBundle\Core\Block;

use AlphaLemon\AlphaLemonCmsBundle\Core\Content\Block\JsonBlock\AlBlockManagerJsonBlockCollection;

/**
 * Defines the Block Manager to handle a Bootstrap Accordion
 *
 * @author AlphaLemon <webmaster@alphalemon.com>
 */
class AlBlockManagerBootstrapAccordionBlock extends AlBlockManagerJsonBlockCollection
{
    /**
     * {@inheritdoc}
     */
    public function getDefaultValue()
    {        
        $value = '
            {
                "0" : {
                    "0": "item"
                },
                "1" : {
                    "0": "item"
                }
            }';
        
        return array('Content' => $value);
    }
    
    /**
     * {@inheritdoc}
     */
    protected function renderHtml()
    {
        $items = $this->decodeJsonContent($this->alBlock->getContent());
        
        return array('RenderView' => array(
            'view' => 'BootstrapAccordionBlockBundle:Content:accordion.html.twig',
            'options' => array('items' => $items),
        ));
    }
}
