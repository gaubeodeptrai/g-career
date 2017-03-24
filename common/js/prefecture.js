$(function prefecture(){

    $(".formSubmitBtn").click(function(){

        var url = '';
        var prm = '';

        var pref = "";
        var nm = 1;
        $(this).parents("form").find("input[name='pref']").each(function(){
              if(pref==""){
                   pref += "pref-";
              }
              if(nm!="1"){
                   pref += "-";
              }
              pref += $(this).val();
              nm++;
        });
        
        if(pref!=""){
            url += "/"+pref;
        }

        var city = "";
        var cityall = 1;
        var nm = 1;
        $(this).parents("form").find("input[name='city[]']").each(function(){
             if($(this).is(":checked")){
                  if(city==""){
                       city += "city-";
                  }
                  if(nm!="1"){
                       city += "-";
                  }
                  city += $(this).val();
                  nm++;
             } else {
                  cityall = 0;
             }
        });

        if(city!=""){

            if(pref==""){
                url += "/"+pref;
            }
            
            if(cityall==0){
                url += "/"+city;
            }
        }
        
        var hrefurl = "/callcenter/search"+url+"/"+prm;
        location.href = hrefurl;
        
        return false;
    });
});