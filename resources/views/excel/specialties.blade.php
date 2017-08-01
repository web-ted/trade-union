<html>
<tr>
    <td>Id</td>
    <td>Name</td>
    <td>Description</td>
    {{--<td>Deleted At</td>--}}
    {{--<td>Created At</td>--}}
    {{--<td>Updated At</td>--}}
</tr>
@foreach ($members as $member)
    <tr>
        <td>{{$member->id}}</td>
        <td>{{$member->name}}</td>
        <td>{{$member->description}}</td>
{{--        <td>{{\Carbon\Carbon::parse($member->deleted_at)->format('d-m-Y')}}</td>--}}
{{--        <td>{{\Carbon\Carbon::parse($member->created_at)->format('d-m-Y')}}</td>--}}
{{--        <td>{{\Carbon\Carbon::parse($member->updated_at)->format('d-m-Y')}}</td>--}}
    </tr>
@endforeach
</html>