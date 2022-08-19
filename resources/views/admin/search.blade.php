<!DOCTYPE html>
<html lang="en" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>البحث عن كفلاء</title>
    <link rel="stylesheet" href="{{asset('assets/sponsers/search.css')}}" />
  </head>
  <body>
    <fieldset
      style="
        padding-right: 150px;
        width: 70%;
        margin-right: 50px;
        margin-top: 10px;
      "
    >
    
    <form action="{{route('search.results')}}" method="get">
      <legend>البحث عن كفيل</legend>
      <input type="radio" name="type" id="radio1" value="personal"  />
      <label for="">شخصي</label>
      <input type="radio" name="type" id="radio1" value="institution" checked />
      <label for="">مؤسسة</label>
        <table width="520" height="250">
          <tr>
            <td>الاسم</td>
            <td colspan="3"><input type="text" name="name"/></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>الدولة</td>
            <td>
              <select name="country_id" id="country">
                <option value="">...</option>
                @foreach($countries as $country)
                <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
              </select>
            </td>
            <td id="responsible_name_lable">مسؤول الاتصال</td>
            <td><input type="text" name="responsible_name" id="responsible_name" /></td>
          </tr>
          <tr>
            
          </tr>
          <tr>
            <td>الجنسية</td>
            <td>
              <select name="nationality" id="">
                <option value="">...</option>
                @foreach($countries as $country)
                <option value="{{$country->name}}">{{$country->name}}</option>
                @endforeach
              </select>
            </td>
            <td>المدينة</td>
            <td>
              <select name="city_id" id="city">
                
              </select>
            </td>
          </tr>
          <tr>
            <td>رقم بطاقة التعريف</td>
            <td colspan="3"><input type="text" name="identifier" /></td>
            <td></td>
            <td></td>
          </tr>
        </table>
        <button
          type="submit"
          style="
            width: 200px;
            height: 30px;
            font-size: 20px;
            margin: 15px 400px 15px 0px;
          "
        >
          بحث
        </button>
      </form>
    </fieldset>
    <a href="{{route('search.index')}}" style="font-size: 22px; margin: 0px 500px 0px;">رجوع</a>
  </body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>


  $(document).ready(function () {
      $("#country").change(function(){
        $('#city').children().remove()
        $('#city').append(new Option('...', '...'))
        let country_id = this.value;
        $.get(`/get_cities?country=${country_id}`, function(data){
          for (i in data){
            items = data[i];
            $('#city').append(`
            <option value="${items.id}">${items.name}</option>  
            `);
          }
        })
      })
    });


  $(document).ready(function (){
    $('input:radio[name="type"]').change(function () {
      if($('#radio1').is(":checked")){
        $('#responsible_name').hide();
        $('#responsible_name_lable').hide();
      }else{
        $('#responsible_name').show();
        $('#responsible_name_lable').show();
      }
    })
  });

</script>
