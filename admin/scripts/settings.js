   let general_data,contacts_data;

      let general_s_form = document.getElementById('general_s_form');
      let site_title_inp = document.getElementById('site_title_inp');
      let site_about_inp = document.getElementById('site_about_inp');
      
      let contacts_s_form = document.getElementById('contacts_s_form');

      // fetching website title and about from database
      function get_general()
      {
        let site_title = document.getElementById('site_title');
        let site_about = document.getElementById('site_about');

        
        let shutdown_toggle = document.getElementById('shutdown_toggle');


        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/settings_crud.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded') ;
        
        xhr.onload = function(){
          general_data = JSON.parse(this.responseText);
          // console.log(general_data);
          site_title.innerText = general_data.site_title;
          site_about.innerText = general_data.site_about;
  
          // on the alert same data
          site_title_inp.value = general_data.site_title;
          site_about_inp.value = general_data.site_about;

          if(general_data.shutdown == 0){
            shutdown_toggle.checked = false;
            shutdown_toggle.value = 0;
          }
          else{
            shutdown_toggle.checked = true;
            shutdown_toggle.value = 1;
          }

        }
        xhr.send('get_general');
      }

      general_s_form.addEventListener('submit',function(e){
          e.preventDefault();
          upd_general(site_title_inp.value,site_about_inp.value);
      });
    
      // change/update website title and about
      function upd_general(site_title_val, site_about_val)
      {
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/settings_crud.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded') ;
        
        xhr.onload = function(){
          var myModal = document.getElementById('general-s');
          var modal = bootstrap.Modal.getInstance(myModal);
          modal.hide();
          // console.log(this.responseText);

          if(this.responseText == 1)
          {
            alert('success','changes saved!');
            // console.log("data updated");
            get_general();
          }
          else
          {
            alert('error','No changes made!');
            // console.log("no changes made");
          }
          

        }
        xhr.send('site_title='+site_title_val+'&site_about='+site_about_val+'&upd_general');
      }

      function upd_shutdown(val)
      {
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/settings_crud.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded') ;
        
        xhr.onload = function(){
          if(this.responseText == 1 && general_data.shutdown == 0) 
          {
            alert('success','site has been shutdown!');
            // console.log("data updated");
            
          }
          else
          {
            alert('success','site is on!');
            // console.log("no changes made");
          }
          get_general();
          

        }
        xhr.send('upd_shutdown='+val);
      }
      // fetching website contacts from database
      function get_contacts()
      {

        let contacts_p_id = ['address','gmap','pn1','email','linkd','tw','yt','wp'];
        let iframe = document.getElementById('iframe')
        
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/settings_crud.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded') ;
        
        xhr.onload = function(){
          contacts_data = JSON.parse(this.responseText);
          contacts_data = Object.values(contacts_data);
          // console.log(contacts_data);

          for(i=0 ; i<contacts_p_id.length ; i++)
          {
            document.getElementById(contacts_p_id[i]).innerText = contacts_data[i+1];
          }
          iframe.src = contacts_data[(contacts_p_id.length)+1];

          contacts_inp(contacts_data);
          

        }
        xhr.send('get_contacts');
      }
      function contacts_inp(data)
      {
        let contacts_inp_id = ['address_inp','gmap_inp','pn1_inp','email_inp','linkd_inp','tw_inp','yt_inp','wp_inp','iframe_inp'];
        
        for(i=0;i<contacts_inp_id.length;i++)
        {
          document.getElementById(contacts_inp_id[i]).value = data[i+1];
          // console.log(data[i+1]);
        }
      }

      contacts_s_form.addEventListener('submit',function(e){
          e.preventDefault();
          upd_contacts();
      });

      function upd_contacts()
      {
        let index = ['address','gmap','pn1','email','linkd','tw','yt','wp','iframe'];
        let contacts_inp_id = ['address_inp','gmap_inp','pn1_inp','email_inp','linkd_inp','tw_inp','yt_inp','wp_inp','iframe_inp'];

        let data_str = "";

        for(i=0;i<index.length;i++)
        {
          data_str += index[i] + "=" + document.getElementById(contacts_inp_id[i]).value + '&';
        }
        // console.log(data_str);
        data_str += "upd_contacts";

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/settings_crud.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded') ;

        xhr.onload = function(){
          var myModal = document.getElementById('contacts-s');
          var modal = bootstrap.Modal.getInstance(myModal);
          modal.hide();
          if(this.responseText == 1) 
          {
            alert('success','Changes saved');
            // console.log("data updated");
            get_contacts();
            
          }
          else
          {
            alert('error','No changes made!');
            // console.log("no changes made");
          }
         
        }
        xhr.send(data_str);
      }

      window.onload = function(){
        get_general();
        get_contacts();
      }