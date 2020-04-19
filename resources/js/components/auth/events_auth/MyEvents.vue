<template>
    <div>
        <table class="table-auto">
            <thead>
            <tr>
                <th class="px-4 py-2">Event Title</th>
                <th class="px-4 py-2">Bookings</th>
                <th class="px-4 py-2">Paid</th>
                <th class="px-4 py-2">View</th>
                <th class="px-4 py-2">Edit</th>
                <th class="px-4 py-2">Delete</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="border px-4 py-2">Intro to CSS</td>
                <td class="border px-4 py-2">Adam</td>
                <td class="border px-4 py-2">858</td>
                <td class="border px-4 py-2">
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        View
                    </button>
                </td>
                <td class="border px-4 py-2">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit
                    </button>
                </td>
                <td class="border px-4 py-2">
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Delete
                    </button>
                </td>
            </tr>
            <tr class="bg-gray-100">
                <td class="border px-4 py-2">A Long and Winding Tour of the History of UI Frameworks and Tools and the
                    Impact on Design
                </td>
                <td class="border px-4 py-2">Adam</td>
                <td class="border px-4 py-2">112</td>
                <td class="border px-4 py-2">
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        View
                    </button>
                </td>
                <td class="border px-4 py-2">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit
                    </button>
                </td>
                <td class="border px-4 py-2">
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Delete
                    </button>
                </td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Intro to JavaScript</td>
                <td class="border px-4 py-2">Chris</td>
                <td class="border px-4 py-2">1,280</td>
                <td class="border px-4 py-2">
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        View
                    </button>
                </td>
                <td class="border px-4 py-2">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit
                    </button>
                </td>
                <td class="border px-4 py-2">
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Delete
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "MyEvents"
    }
</script>

<style scoped>

</style>
