$(document).ready(function() {
    $('#search').hideseek({
    	highlight: true,
    	nodata: '`ไม่พบข้อมูล'
    	});
    //Set Product Thumbnail Equal Height
    equalHeight($(".thumbnail"));
});

function equalHeight(group) {    
    tallest = 0;    
    group.each(function() {       
        thisHeight = $(this).height();       
        if(thisHeight > tallest) {          
            tallest = thisHeight;       
        }    
    });    
    group.each(function() { $(this).height(tallest); });
} 