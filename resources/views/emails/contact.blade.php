@component('mail::message')
# New contact form submission

**Name:** {{ $data['name'] }}  
**Email:** {{ $data['email'] }}  
**Subject:** {{ $data['subject'] }}

---

{{ $data['message'] }}

@component('mail::button', ['url' => 'mailto:' . $data['email']])
Reply to sender
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
