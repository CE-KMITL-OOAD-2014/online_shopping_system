$(document).ready(function() {
    $('#search').hideseek({
    	highlight: true,
    	nodata: '`ไม่พบข้อมูล'
    	});
    //Set shop first page equal
    equalHeight($(".equal"));
});

function equalHeight(group) {    
    tallest = 0;  
    group.each(function() {       
        thisHeight = $(this).height();
        console.log(thisHeight);       
        if(thisHeight > tallest) {          
            tallest = thisHeight;
            console.log("tall : "+tallest);    
        }    
    });    
    group.each(function() { $(this).height(tallest); });
} 