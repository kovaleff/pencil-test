<template>
    <div class="common-layout">
        <el-container>
            <el-header><h1>List of Expenses:</h1></el-header>
            <el-main>
                <ExpenseList></ExpenseList>
            </el-main>
        </el-container>
    </div>
</template>


<script>
    import ExpenseList from "./components/ExpenseList.vue";
    export default {
        name: 'App',
        components: {
            ExpenseList,
        }
    }
</script>
