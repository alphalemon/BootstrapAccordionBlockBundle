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
