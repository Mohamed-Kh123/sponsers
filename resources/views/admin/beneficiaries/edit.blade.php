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
    <title>بيانات المستفيد</title>
    <link rel="stylesheet" href="">
  </head>

  
  <body>
    <fieldset style="width: 71%">
      <legend>بيانات المستفيد</legend>
      <form action="{{route('beneficiary.update', $beneficiary->id)}}" method="POST">
        @csrf
        @method('put')
      <div class="idSection" style="margin-top: 15px">
        <label for="" name="" >نوع المستفيد</label>
        <input type="radio" name="type" value="شهري" @if($beneficiary->type == 'شهري') checked @endif/>
        <label for="id">شهري</label>
        <input type="radio" name="type" value="سنوي" @if($beneficiary->type == 'سنوي') checked @endif/>
        <label for="passport">سنوي</label>
      </div>

      <div class="nameSection" style="margin-top: 15px">
        <label for="" style="margin-left: 3px">الإسم</label>
        <input type="text"  name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name', $beneficiary->name)}}" />
      </div>

      <br>

      <div>
        <label for="">اسم الكفيل</label>
        <select name="sponser_id" id="sponser_id" class="form-control @error('sponser_id') is-invalid @enderror">
            <option value="">...</option>
            @foreach ($sponsers as $sponser)
            <option value="{{ $sponser->id }}" @if($sponser->id == old('sponser_id', $beneficiary->sponser_id)) selected @endif>{{ $sponser->name }}</option>
            @endforeach
        </select>
      </div>


      
  <button>تحديث</button>

  </form>

</fieldset>
<a href="{{route('search.index')}}" style="margin-right: 450px;">البحث عن كفلاء</a>
</body>
</html>




