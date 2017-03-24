$(function station(){

    $(".formSubmitBtn").click(function(){

        var url = '';
        var prm = '';

        var pref = "";
        var nm = 1;
        $(this).parents("form").find("input[name='pref[]']").each(function(){

              if(pref==""){
                   pref += "pref-";
              }
              if(nm!="1"){
                   pref += "-";
              }
              pref+= $(this).val();
              nm++;
              
        });
        
        if(pref!=""){
            url += "/"+pref;
        }
          

        var line = "";
        var nm = 1;
        $(this).parents("form").find("input[name='line[]']").each(function(){

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
        });

        if(line!=""){
            
            url += "/"+line;
        }

        var sta = "";
        var nm = 1;
        $(this).parents("form").find("input[name='sta[]']").each(function(){

             if($(this).parents(".areain").find("input[name='line[]']").is(":checked")){
             
             } else {
             
                 if($(this).is(":checked")){
                      if(sta==""){
                           sta += "sta-";
                      }
                      if(nm!="1"){
                           sta += "-";
                      }
                      sta += $(this).val();
                      nm++;
                 }
             
             }
             
        });
        

        if(sta!=""){
            
            url += "/"+sta;
        }

        if(line=="" && sta==""){
            alert("路線・駅を選択してください");
            return false;
        }
        
        var hrefurl = "/callcenter/search"+url+"/"+prm;
        location.href = hrefurl;
        
        return false;
    });


    $(".formSubmitBtn2").click(function(){

        var line = "";
        var nm = 1;
        $(this).parents("form").find("input[name='line[]']").each(function(){

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
        });
        
        var sta = "";
        var nm = 1;
        $(this).parents("form").find("input[name='sta[]']").each(function(){

             if($(this).parents(".areain").find("input[name='line[]']").is(":checked")){
                 $(this).prop("checked","");
             } else {
             
                 if($(this).is(":checked")){
                      if(sta==""){
                           sta += "sta-";
                      }
                      if(nm!="1"){
                           sta += "-";
                      }
                      sta += $(this).val();
                      nm++;
                 }
             
             }
             
        });
        
        
        if(line=="" && sta==""){
            alert("路線・駅を選択してください");
            return false;
        }
        
        document.stform.submit();
        return false;
        
    });

    $("input[name='line[]']").each(function(){
        if($(this).is(":checked")){
            $(this).parents(".areain").find(".areact").find("input").each(function(){
                $(this).parents(".areain").find(".areact").find("input").prop("checked","checked");
            });
        }
    });
    $("input[name='line[]']").click(function(){
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
    $("input[name='sta[]']").click(function(){
        all = 1;
        $(this).parents(".areact").find("input").each(function(){
            if($(this).is(":checked")){
            } else {
                all = 0;
            }
        });
        
        if(all==1){
            $(this).parents(".areain").find("input[name='line[]']").prop("checked","checked");
        } else {
            $(this).parents(".areain").find("input[name='line[]']").prop("checked","");
        }
        
    });
});