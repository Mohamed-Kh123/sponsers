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
      <legend>البحث عن كفيل</legend>
      <input type="radio" name="rad" id="radio1" />
      <label for="">شخصي</label>
      <input type="radio" name="rad" id="radio1" />
      <label for="">مؤسسة</label>

      <form action="{{route('search')}}" method="get">
        <table width="520" height="250">
          <tr>
            <td>الاسم</td>
            <td colspan="3"><input type="text" name="name" /></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>الدولة</td>
            <td colspan="1">
              <select name="country_id" id="country">
                <option value="">...</option>
                @foreach($countries as $country)
                <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
              </select>
            </td>
          </tr>
          <tr>
            <td>الجنسية</td>
            <td>
              <select name="nationality" id="">
                <option value="">...</option>
                <option value="فلسطين" @if($sponser->nationality == 'فلسطين') selected @endif>فلسطين</option>
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
      </form>
    </fieldset>
    <button
      style="
        width: 200px;
        height: 30px;
        font-size: 20px;
        margin: 15px 400px 15px 0px;
      "
    >
      بحث
    </button>
    <section>
      <table class="result">
        <th>#</th>
        <th>الاسم</th>
        <th>النوع</th>
        <th>الدولة</th>
        <th>المدينة</th>
        <th>رقم الهاتف</th>
        <th>عدد المستفيدين</th>
        <th>عمليات</th>
        <tr>
          <td>{{$sponser->id}}</td>
          <td>{{$sponser->name}}</td>
          <td>#</td>
          <td>{{$sponser->country->name}}</td>
          <td>{{$sponser->city}}</td>
          <td>{{$sponser->telephone}}</td>
          <td>#</td>
          <td>
            <button>ادارة</button
            ><button style="background-color: gold; width: 120px">
              Send SMS
            </button>
          </td>
        </tr>
        <tr style="text-align: right">
          <td colspan="8" style="padding-right: 15px">
            <a href="#">الاول</a> <a href="#">|السابق</a>
            <a href="#">|التالي</a> <a href="#">|الأخير</a>
          </td>
        </tr>
      </table>
    </section>
    <a href="/index.html" style="font-size: 22px; margin: 0px 500px 0px;">رجوع</a>
  </body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>




    $(document).ready(function () {
        $("#country").change(function(){
            let country_id = this.value;
            $.get(`/get_cities?country=${country_id}`, function(data){
            $('#city').html(data);
            })
        })
    });


</script>
