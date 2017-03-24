$(function prefecture(){

    $(".formSubmitBtn").click(function(){

        var url = '';
        var prm = '';

        var pref = "";
        var nm = 1;
        $(this).parents("form").find("input[name='pref']").each(function(){
              pref += $(this).val();
              nm++;
        });
        
        if(pref!=""){
            url += "/"+pref;
        }
  
        var cmp = "";
        var nm = 1;
        $(this).parents("form").find("input[name='cmp[]']").each(function(){
             if($(this).is(":checked")){
                  if(cmp==""){
                       cmp += "cmp-";
                  }
                  if(nm!="1"){
                       cmp += "-";
                  }
                  cmp += $(this).val();
                  nm++;
             }
        });
        
        if(cmp!=""){
            url += "/"+cmp;
        }
        

        var line = "";
        var nm = 1;
        $(this).parents("form").find("input[name='line[]']").each(function(){

             if($(this).parents(".areain").find("input[name='cmp[]']").is(":checked")){

             } else {
             
                 if($(this).is(":checked")){
                      if(line==""){
                           line += "line-";
                      }
                      if(nm!="1"){
                           line += "-";
                      }
                      line += $(this).val();
                      nm++;
                 }
             
             }
        });

        if(line!=""){
            
            url += "/"+line;
        }
        
        if(cmp=="" && line==""){
            alert("沿線・路線を選択してください");
            return false;
        }
        
        var hrefurl = "/callcenter/sta"+url+"/"+prm;
        location.href = hrefurl;
        
        return false;
    });
    
    $("input[name='cmp[]']").click(function(){
        if($(this).is(":checked")){
            $(this).parents(".areain").find(".areact").find("input").each(function(){
                $(this).parents(".areain").find(".areact").find("input").prop("checked","checked");
            });
        } else {
            $(this).parents(".areain").find(".areact").find("input").each(function(){
                $(this).parents(".areain").find(".areact").find("input").prop("checked","");
            });
        }
    });
    $("input[name='line[]']").click(function(){
        all = 1;
        $(this).parents(".areact").find("input").each(function(){
            if($(this).is(":checked")){
            } else {
                all = 0;
            }
        });
        
        if(all==1){
            $(this).parents(".areain").find("input[name='cmp[]']").prop("checked","checked");
        } else {
            $(this).parents(".areain").find("input[name='cmp[]']").prop("checked","");
        }
        
    });
});