<html>
<tr>
    <td>Id</td>
    <td>Name</td>
    <td>Address</td>
    <td>Region</td>
    <td>Phone</td>
    <td>Fax</td>
    <td>Email</td>
    <td>City</td>
    <td>Founded</td>
    <td>Workers_number</td>
    <td>Owners</td>
    <td>Business_activity</td>
    {{--<td>Deleted At</td>--}}
    {{--<td>Created At</td>--}}
    {{--<td>Updated At</td>--}}
</tr>
@foreach ($members as $member)
    <tr>
        <td>{{$member->id}}</td>
        <td>{{$member->name}}</td>
        <td>{{$member->address}}</td>
        <td>{{$member->region}}</td>
        <td>{{$member->phone}}</td>
        <td>{{$member->fax}}</td>
        <td>{{$member->email}}</td>
        <td>{{$member->city}}</td>
        <td>{{\Carbon\Carbon::parse($member->founded)->format('d-m-Y')}}</td>
        <td>{{$member->workers_number}}</td>
        <td>{{$member->owners}}</td>
        <td>{{$member->business_activity}}</td>
{{--        <td>{{\Carbon\Carbon::parse($member->deleted_at)->format('d-m-Y')}}</td>--}}
{{--        <td>{{\Carbon\Carbon::parse($member->created_at)->format('d-m-Y')}}</td>--}}
{{--        <td>{{\Carbon\Carbon::parse($member->updated_at)->format('d-m-Y')}}</td>--}}
    </tr>
@endforeach
</html>