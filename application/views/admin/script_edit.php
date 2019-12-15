<script type="text/javascript">
  changeForm();
  function changeForm(){
    var name = <?php echo json_encode($name);?>;
    var value = <?php echo json_encode($form_value);?>;
    console.log(name);
    console.log(value);
    for(var i=0;i<name.length;i++){
      var key = name[i];
      var input = document.getElementsByName(key)[0];
      if(input){
        console.log(input);
        if(name[i]=='user_password'){
          input.setAttribute('readonly','readonly');
          input.setAttribute('type','hidden');
        }else if(input.nodeName == 'SELECT'){
          var option = input.getElementsByTagName('option');
          for(var j=0; j<option.length; j++){
            if(value[''+key]==option[j].value){
              option[j].selected = 'selected';
            }
          }
        }else if(input.nodeName == 'TEXTAREA'){
          input.innerHTML = value[''+key];
        }else{
          console.log(value[""+key]);
          input.setAttribute('value','' + value[''+key]);
        }
      }
    }

    //document.getElementById('editForm').innerHTML = this.responseText;
  }
</script>
