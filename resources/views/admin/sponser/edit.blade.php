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
        <input type="radio" name="ident_type" value="identification" @if($sponser->ident_type == 'identification') checked @endif/>
        <label for="id">هوية</label>
        <input type="radio" name="ident_type" value="passport" @if($sponser->ident_type == 'passport') checked @endif/>
        <label for="passport">جواز السفر</label>
        <label for="" style="margin-right: 30px">رقم بطاقة التعريف</label>
        <input type="text" name="identifier" class="form-control @error('identifier') is-invalid @enderror" id="identifier" value="{{old('identifier', $sponser->identifier)}}" />
        
      </div>

      @php 
      $name = explode(' ',$sponser->name);

      $first_name = $name[0];
      $second_name = $name[1];
      $third_name = $name[2];
      $family_name = $name[3];
      
      @endphp

      <div class="nameSection" style="margin-top: 15px">
        <label for="" style="margin-left: 3px">الإسم</label>
        <input type="text"  name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{$first_name}}"/>
        <input type="text"  name="second_name"class="form-control @error('second_name') is-invalid @enderror"value="{{$second_name}}"/>
        <input type="text"  name="third_name" class="form-control @error('third_name') is-invalid @enderror" value="{{$third_name}}"/>
        <input type="text"  name="family_name" class="form-control @error('family_name') is-invalid @enderror"value="{{$family_name}}"/>
      </div>
      <div class="location" style="margin-top: 15px">
        
        <label for="" style="margin-right: 15px">دولة الإقامة</label>
        <select name="country_id" id="country" class="form-control @error('country') is-invalid @enderror">
          <option value="">الدولة</option>
          @foreach($countries as $country)
          <option value="{{$country->id}}" @if($country->id == old('country_id', $sponser->country->id)) selected @endif >{{$country->name}}</option>          
          @endforeach
        </select>
        
        <label for="" style="margin-right: 15px">المدينة</label>
        <select name="city_id" id="city" class="form-control @error('city') is-invalid @enderror" >
            <option value="">...</option>
            @foreach($cities as $city)
            <option value="{{$city->id}}"@if($city->id == old('city_id', $sponser->city->id)) selected @endif>{{$city->name}}</option>
            @endforeach
        </select>
        

      </div>
      <div class="detailsOfLocation" style="margin-top: 15px">
        <label for="">تفاصيل العنوان</label>
        <input type="text" style="width: 850px" name="address" class="form-control @error('address') is-invalid @enderror" value="{{old('address', $sponser->address)}}" />
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
          <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" value = "{{old('telephone', $sponser->telephone)}}"/>
          
        </div>
        <div>
          <label for="">الجوال</label>
          <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone', $sponser->phone)}}"/>
          
        </div>
        <div>
          <label for="">البريد</label>
          <input type="email" name="email"class="form-control @error('email') is-invalid @enderror" value="{{old('email', $sponser->email)}}"/>
          
        </div>
      </div>
      <div class="nationality" style="margin: 15px 0px">
        <label for="">الجنسية</label>
        <select name="nationality" id="nationality" class="form-control @error('nationality') is-invalid @enderror" >
          @foreach($countries as $country)
          <option value="{{$country->name}}" @if($country->id == old('nationality', $sponser->nationality)) selected @endif >{{$country->name}}</option>          
          @endforeach
        </select>

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
        <select name="country_id"  class="form-control @error('country') is-invalid @enderror">
          <option value="">الدولة</option>
          @foreach($countries as $country)
          <option value="{{$country->id}}" @if($country->id == old('country_id', $sponser->country->id)) selected @endif >{{$country->name}}</option>
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
        <input type="email" name="email"  class="form-controll @error('email') is-invalid @enderror" value="{{old('email', $sponser->email)}}">

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
        $('#city').children().remove()
        $('#city').append(new Option('...', '...'))
        let country_id = this.value;
        $.get(`/get_cities?country=${country_id}`, function(data){
          for (i in data){
            items = data[i];
            $('#city').append(`
            <option value="">...</option>  
            <option value="${items.id}">${items.name}</option>  
            `);
          }
        })
      })
    });


</script>






