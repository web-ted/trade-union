<html>
<tr>
    <td>Id</td>
    <td>Active</td>
    <td>Registration Number</td>
    <td>Registered At</td>
    <td>First Name</td>
    <td>Last Name</td>
    <td>Father Name</td>
    <td>Birth Date</td>
    <td>Id Card</td>
    <td>Phone</td>
    <td>Mobile Phone</td>
    <td>Email</td>
    <td>Address</td>
    <td>Postal Code</td>
    <td>Region</td>
    <td>City</td>
    <td>Hire Date</td>
    <td>Insurance Number</td>
    <td>Comment</td>
    <td>Enterprise</td>
    <td>Specialty</td>
    {{--<td>Created At</td>--}}
    {{--<td>Updated At</td>--}}
    {{--<td>Deleted At</td>--}}
</tr>
@foreach ($members as $member)
    <tr>
        <td>{{$member->id}}</td>
        <td>{{($member->active == 0)?'Inactive':'Active'}}</td>
        <td>{{$member->registration_number}}</td>
        <td>{{\Carbon\Carbon::parse($member->registered_at)->format('d-m-Y')}}</td>
        <td>{{$member->first_name}}</td>
        <td>{{$member->last_name}}</td>
        <td>{{$member->father_name}}</td>
        <td>{{\Carbon\Carbon::parse($member->birth_date)->format('d-m-Y')}}</td>
        <td>{{$member->id_card}}</td>
        <td>{{$member->phone}}</td>
        <td>{{$member->mobile_phone}}</td>
        <td>{{$member->email}}</td>
        <td>{{$member->address}}</td>
        <td>{{$member->postal_code}}</td>
        <td>{{$member->region}}</td>
        <td>{{$member->city}}</td>
        <td>{{\Carbon\Carbon::parse($member->hire_date)->format('d-m-Y')}}</td>
        <td>{{$member->insurance_number}}</td>
        <td>{{$member->comment}}</td>
        <td>{{isset($member->enterprise) ? $member->enterprise->name : ''}}</td>
{{--        <td>{{$member->enterprise->name ?? ''}}</td>--}}
        <td>{{isset($member->specialty) ? $member->specialty->name : ''}}</td>
{{--        <td>{{$member->specialty->name ?? '' }}</td>--}}
        {{--<td>{{$member->created_at}}</td>--}}
        {{--<td>{{$member->updated_at}}</td>--}}
        {{--<td>{{$member->deleted_at}}</td>--}}
    </tr>
@endforeach
</html>