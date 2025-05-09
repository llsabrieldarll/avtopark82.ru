<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';
import {
    FlexRender,
    getCoreRowModel,
    useVueTable,
    createColumnHelper,
} from '@tanstack/vue-table'
import { ref } from 'vue'

const props = defineProps<Props>();

const defaultData = props.users

const columnHelper = createColumnHelper()

const columns = [
    columnHelper.accessor('id', {
        cell: info => info.getValue(),
        header: () => 'ID',
    }),
    columnHelper.accessor('name', {
        id: 'username',
        cell: info => info.getValue(),
        header: () => 'Name',
    }),
    columnHelper.accessor('email', {
        cell: info => info.getValue(),
        header: () => 'Email',
    }),
    columnHelper.accessor('status', {
        cell: info => info.getValue(),
        header: () => 'Status',
    }),
]

const data = ref(defaultData)

const table = useVueTable({
    get data() {
        return data.value
    },
    columns: columns,
    getCoreRowModel: getCoreRowModel(),
})

interface Props {
    title: string;
    users: object;
}



const breadcrumbs: BreadcrumbItem[] = [
    {
        title: props.title,
        href: '/users',
    },
];
</script>

<template>
    <Head :title="title" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container py-10 mx-auto">
            <table>
                <thead>
                <tr
                    v-for="headerGroup in table.getHeaderGroups()"
                    :key="headerGroup.id"
                >
                    <th
                        v-for="header in headerGroup.headers"
                        :key="header.id"
                        :colSpan="header.colSpan"
                    >
                        <FlexRender
                            v-if="!header.isPlaceholder"
                            :render="header.column.columnDef.header"
                            :props="header.getContext()"
                        />
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="row in table.getRowModel().rows" :key="row.id">
                    <td v-for="cell in row.getVisibleCells()" :key="cell.id">
                        <FlexRender
                            :render="cell.column.columnDef.cell"
                            :props="cell.getContext()"
                        />
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr
                    v-for="footerGroup in table.getFooterGroups()"
                    :key="footerGroup.id"
                >
                    <th
                        v-for="header in footerGroup.headers"
                        :key="header.id"
                        :colSpan="header.colSpan"
                    >
                        <FlexRender
                            v-if="!header.isPlaceholder"
                            :render="header.column.columnDef.footer"
                            :props="header.getContext()"
                        />
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </AppLayout>
</template>
