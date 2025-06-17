<a href="{{ route('business.getRegister') }}@if (!empty(request()->lang)) {{ '?lang=' . request()->lang }} @endif"
class="tw-text-lg tw-font-medium tw-bg-gradient-to-r tw-from-indigo-500 tw-to-blue-500 tw-inline-block tw-text-white tw-bg-clip-text hover:tw-text-[#467BF5] hover:tw-underline">{{ __('business.register_now') }}</a>
