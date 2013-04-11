<?php
/**
 * An AlphaLemonCms Block
 */

namespace AlphaLemon\Block\BootstrapAccordionBlockBundle\Core\Block;

use AlphaLemon\AlphaLemonCmsBundle\Core\Content\Block\AlBlockManagerContainer;
use AlphaLemon\AlphaLemonCmsBundle\Core\Content\Block\JsonBlock\AlBlockManagerJsonBlock;

/**
 * Description of AlBlockManagerBootstrapAccordionBlock
 */
class AlBlockManagerBootstrapAccordionBlock extends AlBlockManagerContainer
{
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
    
    protected function renderHtml()
    {
        $items = AlBlockManagerJsonBlock::decodeJsonContent($this->alBlock->getContent());
        
        return array('RenderView' => array(
            'view' => 'BootstrapAccordionBlockBundle:Content:accordion.html.twig',
            'options' => array('items' => $items),
        ));
    }
    
    protected function edit(array $values)
    {
        $data = json_decode($values['Content'], true); 
        $savedValues = AlBlockManagerJsonBlock::decodeJsonContent($this->alBlock);
        
        if ($data["operation"] == "add") {
            $savedValues[] = $data["value"];
            $values = array("Content" => json_encode($savedValues));
        }
        
        if ($data["operation"] == "remove") {
            unset($savedValues[$data["item"]]);
            
            $blocksRepository = $this->container->get('alpha_lemon_cms.factory_repository');
            $repository = $blocksRepository->createRepository('Block');
            $repository->deleteIncludedBlocks($data["slotName"]);
            
            $values = array("Content" => json_encode($savedValues));
        }
        
        return parent::edit($values);
    }
}
