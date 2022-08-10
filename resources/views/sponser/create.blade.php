@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!DOCTYPE html>
<html lang="en" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>بيانات الكفيل</title>
    <link rel="stylesheet" href="">
  </head>
  <body>
    <fieldset style="width: 71%">
      <legend>بيانات الكفيل</legend>

      <div class="personalInstitution">
          <input type="radio" name="mamo" id="radio1" value="personal" />
          <label for="personal">شخصي</label>
          <input type="radio" name="mamo" id="radio2" value="institution" checked />
          <label for="institution">مؤسسة</label>
      </div>
      
      <form action="{{route('sponsers.store')}}" method="POST" id="form1" style="display:none">
        @csrf
        <input type="hidden" name="type" value="personal">
      <div class="idSection" style="margin-top: 15px">
        <label for="" name="ident_type" >بطاقة التعريف</label>
        <input type="radio" name="ident_type" value="identification"/>
        <label for="id">هوية</label>
        <input type="radio" name="ident_type" value="passport" />
        <label for="passport">جواز السفر</label>
        <label for="" style="margin-right: 30px">رقم بطاقة التعريف</label>
        <input type="text" name="identifier" class="form-control @error('identifier') is-invalid @enderror" id="identifier" value="{{old('identifier', $sponser->identifier)}}" />
      </div>


      <div class="nameSection" style="margin-top: 15px">
        <label for="" style="margin-left: 3px">الإسم</label>
        <input type="text"  name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{old('first_name', $sponser->first_Name)}}"  />
        <input type="text"  name="second_name"class="form-control @error('second_name') is-invalid @enderror"value="{{old('second_name', $sponser->second_name)}}"/>
        <input type="text"  name="third_name" class="form-control @error('third_name') is-invalid @enderror" value="{{old('third_name', $sponser->third_name)}}"/>
        <input type="text"  name="family_name" class="form-control @error('family_name') is-invalid @enderror" value="{{old('family_name', $sponser->family_name)}}"/>
      </div>
      <div class="location" style="margin-top: 15px">
        
        <label for="" style="margin-right: 15px">دولة الإقامة</label>
        <select name="country_id" id="country" class="form-control @error('country_id') is-invalid @enderror" >
          <option>الدولة</option>
          @foreach($countries as $country)
          <option value="{{$country->id}}">{{$country->name}}</option>
          @endforeach
        </select>
        <label for="" style="margin-right: 15px">المدينة</label>
        <select name="city_id" id="city" class="form-control @error('city_id') is-invalid @enderror" >
          
        </select>

      </div>
      <div class="detailsOfLocation" style="margin-top: 15px">
        <label for="">تفاصيل العنوان</label>
        <input type="text" style="width: 850px" name="address" class="form-control @error('address') is-invalid @enderror" {{old('address', $sponser->address)}} />
      </div>
      <div
        class="contactInfo"
        style="
          display: flex;
          justify-content: space-between;
          margin-top: 15px;
        "
      >
        <div>
          <label for="">الهاتف</label>
          <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" {{old('telephone', $sponser->telephone)}}/>
        </div>
        <div>
          <label for="">الجوال</label>
          <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" {{old('phone', $sponser->phone)}} />
        </div>
        <div>
          <label for="">البريد</label>
          <input type="email" name="email"class="form-control @error('email') is-invalid @enderror" {{old('email', $sponser->email)}} />
        </div>
      </div>
      <div class="nationality" style="margin: 15px 0px">
        <label for="">الجنسية</label>
        <select name="nationality" id="nationality" class="form-control @error('nationality') is-invalid @enderror" >
          <option value="">...</option>
          <option value="فلسطيني" @if($sponser->nationality == 'فلسطيني') selected @endif>فلسطين</option>
        </select>
      </div>
  <button>حفظ</button>

  </form>

  <form action="{{route('sponsers.store')}}" style="text-align: center" method="POST" id='form2'>
    @csrf
    <input type="hidden" name="type" value="institution">
    <label for="" style="margin-right: 15px">الدولة</label>
        <select name="country_id"  class="form-control @error('country_id') is-invalid @enderror">
          <option>الدولة</option>
          @foreach($countries as $country)
          <option value="{{$country->id}}">{{$country->name}}</option>
          @endforeach
        </select>
        <br><br>

    <label for="name">الاسم</label>
    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name', $sponser->name)}}"><br><br>

    <label for="responsibleOfContact">مسؤول الإتصال<label>
    <input type="text" id="responsibleOfContact" name="responsible_name" class="form-control @error('responsible_name') is-invaild @enderror" value="{{old('responsible_name', $sponser->responsible_name)}}"><br><br>

    <label for="location">العنوان</label>
    <input type="text" id="location" name="address" class="form-controll @error('address') is-invalid @enderror" value="{{old('address', $sponser->address)}}"><br><br>

    <div class="telephone">
        <div class="tele1">
            <label for="tele1">الهاتف1</label>
            <input type="text" id="phone" name="phone"  class="form-controll @error('phone') is-invalid @enderror" value="{{old('phone', $sponser->phone)}}">

        </div><br><br>
        <div class="tele2">
            <label for="tele2">الهاتف2</label>
            <input type="text" id="tele2" name="phone2" class="form-controll @error('phone2') is-invalid @enderror" value="{{old('phone2', $sponser->phone2)}}">

        </div><br><br>
        <label for="">البريد</label>
        <input type="text" name="email" id="" class="form-controll @error('email') is-invalid @enderror" value="{{old('email', $sponser->email)}}">

    </div>    

    <button>حفظ</button>
  </form>

</fieldset>
<a href="/search/search.html" style="margin-right: 450px;">البحث عن كفلاء</a>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>

    $('input:radio[name="mamo"]').change(function () {
        if ($('#radio1').is(':checked')) {
            $('#form1').css('display', 'block');
            $('#form2').css('display', 'none');
        } else if($('#radio2').is(':checked')) {
            $('#form1').css('display', 'none');
            $('#form2').css('display', 'block');
        }
    }); 


    $(document).ready(function () {
      $("#country").change(function(){
        let country_id = this.value;
        $.get(`/get_cities?country=${country_id}`, function(data){
          $('#city').html(data);
        })
      })
    });



</script>





