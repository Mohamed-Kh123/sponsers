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

      @if($sponser->type == 'personal')
      <form action="{{route('sponsers.update', $sponser->id)}}" method="POST" id="form1">
        @csrf
        @method('PUT')
        <input type="hidden" name="type" value="personal">
      <div class="idSection" style="margin-top: 15px">
        <label for="" name="ident_type" >بطاقة التعريف</label>
        <input type="radio" name="ident_type" value="identification"/>
        <label for="id">هوية</label>
        <input type="radio" name="ident_type" value="passport" />
        <label for="passport">جواز السفر</label>
        <label for="" style="margin-right: 30px">رقم بطاقة التعريف</label>
        <input type="text" name="identifier" class="form-control @error('identifier') is-invalid @enderror" id="identifier" value="{{old('identifier', $sponser->identifier)}}" />
        @error('identifier')
        <p class="invalid-feedback">{{$message}}</p>
        @enderror
      </div>


      <div class="nameSection" style="margin-top: 15px">
        <label for="" style="margin-left: 3px">الإسم</label>
        <input type="text"  name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{old('first_name', $sponser->first_Name)}}"  />
        <input type="text"  name="second_name"class="form-control @error('second_name') is-invalid @enderror"value="{{old('second_name', $sponser->second_name)}}"/>
        <input type="text"  name="third_name" class="form-control @error('third_name') is-invalid @enderror" value="{{old('third_name', $sponser->third_name)}}"/>
        <input type="text"  name="family_name" class="form-control @error('family_name') is-invalid @enderror" value="{{old('family_name', $sponser->family_name)}}"/>
        @error('first_Name'|'second_name'|'ThirdName'|'familyName')
        <p class="invalid-feedback">{{ $message }}</p>
        @enderror
      </div>
      <div class="location" style="margin-top: 15px">
        
        <label for="" style="margin-right: 15px">دولة الإقامة</label>
        <select name="country" id="country" class="form-control @error('country') is-invalid @enderror">
          <option value="">الدولة</option>
          @foreach($countries as $country)
          <option value="{{$country->name}}" @if($country->name == old('country', ($sponser->country ?? null))) selected @endif>{{$country->name}}</option>
          @endforeach
        </select>
        @error('country')
        <p class="invalid-feedback">{{ $message }}</p>
        @enderror
        <label for="" style="margin-right: 15px">المدينة</label>
        <select name="city" id="city" class="form-control @error('city') is-invalid @enderror" >

        </select>
        @error('city')
        <p class="invalid-feedback">{{ $message }}</p>
        @enderror

      </div>
      <div class="detailsOfLocation" style="margin-top: 15px">
        <label for="">تفاصيل العنوان</label>
        <input type="text" style="width: 850px" name="address" class="form-control @error('address') is-invalid @enderror" {{old('address', $sponser->address)}} />
        @error('address')
        <p class="invalid-feedback">{{ $message }}</p>
        @enderror
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
          @error('telephone')
        <p class="invalid-feedback">{{ $message }}</p>
        @enderror
        </div>
        <div>
          <label for="">الجوال</label>
          <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" {{old('phone', $sponser->phone)}} />
          @error('phone')
        <p class="invalid-feedback">{{ $message }}</p>
        @enderror
        </div>
        <div>
          <label for="">البريد</label>
          <input type="email" name="email"class="form-control @error('email') is-invalid @enderror" {{old('email', $sponser->email)}} />
          @error('email')
        <p class="invalid-feedback">{{ $message }}</p>
        @enderror
        </div>
      </div>
      <div class="nationality" style="margin: 15px 0px">
        <label for="">الجنسية</label>
        <select name="nationality" id="nationality" class="form-control @error('nationality') is-invalid @enderror" >
          
        </select>
        @error('nationality')
        <p class="invalid-feedback">{{ $message }}</p>
        @enderror
      </div>
  <button>تحديث</button>

  </form>
@endif

@if($sponser->type == 'institution')
  <form action="{{route('sponsers.update', $sponser->id)}}" style="text-align: center" method="POST" id='form2'>
    @csrf
    @method('PUT')
    <input type="hidden" name="type" value="institution">
    <label for="" style="margin-right: 15px">الدولة</label>
        <select name="country"  class="form-control @error('country') is-invalid @enderror">
          <option value="">الدولة</option>
          @foreach($countries as $country)
          <option value="{{$country->name}}">{{$country->name}}</option>
          @endforeach
        </select>
        @error('country')
        <p class="invalid-feedback">{{ $message }}</p>
        @enderror<br><br>

    <label for="name">الاسم</label>
    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name', $sponser->name)}}"><br><br>
    @error('name')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
    <label for="responsibleOfContact">مسؤول الإتصال<label>
    <input type="text" id="responsibleOfContact" name="responsible_name" class="form-control @error('responsible_name') is-invaild @enderror" value="{{old('responsible_name', $sponser->responsible_name)}}"><br><br>
    @error('responsible_name')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
    <label for="location">العنوان</label>
    <input type="text" id="location" name="address" class="form-controll @error('address') is-invalid @enderror" value="{{old('address', $sponser->address)}}"><br><br>
    @error('address')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
    <div class="telephone">
        <div class="tele1">
            <label for="tele1">الهاتف1</label>
            <input type="text" id="phone" name="phone"  class="form-controll @error('phone') is-invalid @enderror" value="{{old('phone', $sponser->phone)}}">
            @error('phone')
            <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div><br><br>
        <div class="tele2">
            <label for="tele2">الهاتف2</label>
            <input type="text" id="tele2" name="phone2" class="form-controll @error('phone2') is-invalid @enderror" value="{{old('phone2', $sponser->phone2)}}">
            @error('phone2')
            <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div><br><br>
        <label for="">البريد</label>
        <input type="email" name="email"  class="form-controll @error('email') is-invalid @enderror" value="{{old('email', $sponser->email)}}">
        @error('email')
        <p class="invalid-feedback">{{$message}}</p>
        @enderror
    </div>    

    <button>تحديث</button>
  </form>
  @endif

</fieldset>
<a href="/search/search.html" style="margin-right: 450px;">البحث عن كفلاء</a>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>


    $(document).ready(function () {
      $("#country").change(function(){
        let country_id = this.value;
        $.get("/get_cities?country="+country_id, function(data){
          $('#city').html(data);
        })
      })
    });


</script>





