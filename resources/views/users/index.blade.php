<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                إدارة المستخدمين
            </h2>
            <a href="{{ route('super.dashboard') }}"
                class="px-5 py-2.5 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-xl text-sm font-medium transition flex items-center gap-2">
                ← العودة للوحة التحكم
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 dark:border-gray-700">

                <!-- شريط البحث -->
                <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                    <form method="GET" class="flex max-w-lg">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="ابحث بالاسم أو البريد الإلكتروني..."
                            class="flex-1 rounded-l-2xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-5 py-3 outline-none text-sm">
                        <button type="submit"
                            class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-r-2xl font-medium transition flex items-center gap-2">
                            <span>بحث</span>
                        </button>
                    </form>
                </div>

                <!-- الجدول -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-right">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-4 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    الاسم</th>
                                <th
                                    class="px-6 py-4 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    البريد الإلكتروني</th>
                                <th
                                    class="px-6 py-4 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    الدور</th>
                                <th
                                    class="px-6 py-4 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    تاريخ التسجيل</th>
                                <th
                                    class="px-6 py-4 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider w-40">
                                    تغيير الدور</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($users as $user)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <td
                                        class="px-6 py-5 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <span
                                            class="inline-flex px-3 py-1 text-xs font-semibold rounded-full
                                            {{ $user->isSuperAdmin()
                                                ? 'bg-purple-100 text-purple-700 border border-purple-200'
                                                : ($user->isAdmin()
                                                    ? 'bg-blue-100 text-blue-700 border border-blue-200'
                                                    : 'bg-emerald-100 text-emerald-700 border border-emerald-200') }}">
                                            {{ $user->isSuperAdmin() ? 'مدير' : ($user->isAdmin() ? 'مشرف' : 'طالب') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $user->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <form action="{{ route('users.update-role', $user->id) }}" method="POST"
                                            class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="role" onchange="this.form.submit()"
                                                class="text-sm border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                                                <option value="student"
                                                    {{ $user->role === 'student' ? 'selected' : '' }}>طالب</option>
                                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                                    مشرف</option>
                                                <option value="super_admin"
                                                    {{ $user->role === 'super_admin' ? 'selected' : '' }}> مدير
                                                </option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center">
                                            <span class="text-6xl mb-4 opacity-30">👥</span>
                                            <p class="text-lg text-gray-500 dark:text-gray-400">لا يوجد مستخدمين مسجلين
                                                حاليًا</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-5 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
