<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/sponsers/search.css')}}" />
    <title>البحث عن كفلاء</title>
</head>
<body>
        <table class="result">
          <th>الاسم</th>
          <th>النوع</th>
          <th>الدولة</th>
          <th>الجنسية</th>
          <th>المدينة</th>
          <th>رقم بطاقة التعريف</th>
          <th>مسؤول الاتصال</th>
          <th>رقم الهاتف</th>
          <th>عدد المستفيدين</th>
          <th>عمليات</th>
          <tr>
            @foreach($sponsers as $sponser)
                    <td>{{$sponser->name}}</td>
                    <td>{{$sponser->type}}</td>
                    <td>{{$sponser->country->name}}</td>
                    <td>{{$sponser->nationality}}</td>
                    <td>{{$sponser->city->name ?? ''}}</td>
                    <td>{{$sponser->identifier}}</td>
                    <td>{{$sponser->responsible_name}}</td>
                    <td>{{$sponser->telephone}}</td>
                    <td>#</td>
                    <td>
                      <button>ادارة</button
                      ><button style="background-color: gold; width: 120px">
                        Send SMS
                      </button>
                    </td>
                  </tr>
                  @endforeach
                  <tr style="text-align: right">
                    <td colspan="8" style="padding-right: 15px">
                      <a href="#">الاول</a> <a href="#">|السابق</a>
                      <a href="#">|التالي</a> <a href="#">|الأخير</a>
                    </td>
                  </tr>
        </table>
</body>
</html>