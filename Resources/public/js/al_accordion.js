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
 
$(document).ready(function() 
{
    var expandAccordion = function() {
        $("#al-accordion").find('.collapse').removeClass('in').addClass('in');
    };
        
    $(document).on("cmsStarted", function(event){
        expandAccordion();
    });
    
    $(document).on("cmsStopped", function(event){
        $("#al-accordion").find('.collapse').removeClass('in');
    });
    
    $(document).on("blockEditing", function(event, element){
        if (element.attr('data-type') != 'BootstrapAccordionBlock') {
            return;
        }
        
        element.inlinelist('start', {             
            target: '> div',
            addValue: '{"operation": "add", "value": { "0": "item" }}',
            addItemCallback: expandAccordion,
            deleteItemCallback: expandAccordion
        }); 
    });
    
    $(document).on("blockStopEditing", function(event, element){ 
        if (element.attr('data-type') != 'BootstrapAccordionBlock') {
            return;
        }
                
        element.inlinelist('stop');
    });
});
