@extends('layouts.admin')

@section('header', 'Contact Inquiries')

@section('content')
<div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-900">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sender</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($contacts as $contact)
            <tr class="{{ $contact->status == 'unread' ? 'bg-blue-50/50 dark:bg-blue-900/10' : '' }}">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $contact->name }}</div>
                    <div class="text-sm text-gray-500">{{ $contact->email }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-900 dark:text-gray-300 font-medium">{{ Str::limit($contact->subject, 40) }}</div>
                    <div class="text-sm text-gray-500 line-clamp-1">{{ $contact->message }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex flex-col gap-1">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full w-max
                            {{ $contact->status == 'unread' ? 'bg-red-100 text-red-800' : ($contact->status == 'replied' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') }}">
                            {{ ucfirst($contact->status) }}
                        </span>
                        @if($contact->status == 'replied' && isset($contact->delivery_status))
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full w-max 
                            {{ $contact->delivery_status == 'delivered' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800' }}">
                            Mail: {{ ucfirst($contact->delivery_status) }}
                        </span>
                        @endif
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $contact->created_at->format('M d, Y h:i A') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button type="button" @click="$dispatch('open-modal', 'reply-modal-{{ $contact->_id }}')" class="text-primary-600 hover:text-primary-900 mr-3">View & Reply</button>
                    <form action="{{ route('admin.contacts.destroy', $contact->_id) }}" method="POST" class="inline" onsubmit="return confirm('Delete message?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                    </form>
                </td>
            </tr>

            <!-- Alpine Modal for Reply -->
            <tr x-data="{ open: false }" @open-modal.window="if ($event.detail === 'reply-modal-{{ $contact->_id }}') open = true">
                <td colspan="5" class="p-0">
                    <div x-show="open" class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak>
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                <div class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                                    <form action="{{ route('admin.contacts.reply', $contact->_id) }}" method="POST" x-data="{ loading: false }" @submit="loading = true">
                                        @csrf
                                        <div class="bg-white dark:bg-gray-800 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Reply to {{ $contact->name }}</h3>
                                            
                                            <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-md mb-4 border border-gray-200 dark:border-gray-700">
                                                <p class="font-medium text-sm text-gray-900 dark:text-white">Subject: {{ $contact->subject }}</p>
                                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">{{ $contact->message }}</p>
                                            </div>

                                            @if(!empty($contact->reply_history))
                                            <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-md mb-4 border border-green-200 dark:border-green-800 max-h-60 overflow-y-auto">
                                                <p class="font-medium text-sm text-green-800 dark:text-green-200 mb-2">Reply History:</p>
                                                @foreach($contact->reply_history as $reply)
                                                <div class="mb-3 border-b border-green-200 dark:border-green-800 pb-2 last:border-0 last:pb-0">
                                                    <p class="text-xs text-green-600 dark:text-green-400 mb-1">{{ \Carbon\Carbon::parse($reply['replied_at'])->format('M d, Y h:i A') }}</p>
                                                    <p class="text-sm text-green-700 dark:text-green-300">{{ $reply['message'] }}</p>
                                                </div>
                                                @endforeach
                                            </div>
                                            @elseif($contact->status === 'replied')
                                            <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-md mb-4 border border-green-200 dark:border-green-800">
                                                <p class="font-medium text-sm text-green-800 dark:text-green-200">Previous Reply ({{ $contact->replied_at?->format('M d, Y') }}):</p>
                                                <p class="mt-2 text-sm text-green-700 dark:text-green-300">{{ $contact->admin_reply }}</p>
                                            </div>
                                            @endif

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Your Reply</label>
                                                <textarea name="reply_message" rows="5" required class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"></textarea>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                            <button type="submit" :disabled="loading" class="inline-flex w-full justify-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 sm:ml-3 sm:w-auto disabled:opacity-50">
                                                <span x-show="!loading">Send Reply</span>
                                                <span x-show="loading" x-cloak>Sending...</span>
                                            </button>
                                            <button type="button" @click="open = false" :disabled="loading" class="mt-3 inline-flex w-full justify-center rounded-md bg-white dark:bg-gray-800 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-300 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 sm:mt-0 sm:w-auto disabled:opacity-50">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4 border-t border-gray-200 dark:border-gray-700">
        {{ $contacts->links() }}
    </div>
</div>
@endsection
