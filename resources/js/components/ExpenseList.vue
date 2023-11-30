<script setup>
import {ref} from 'vue'
import Api from '../api/api'
import {ElNotification} from 'element-plus'

const dialogVisible = ref(false)
const editFormVisible = ref(false)
const currentRow = ref(false)
const currentRowData = ref([])
const editedSumm = ref();
const editedComment = ref();
let expenses = ref({})
let links = ref(false)
let dataLoaded = ref(false)

const handleEditClick = (index) => {
    dialogVisible.value = true
    editFormVisible.value = true
    currentRow.value = index
    editedSumm.value = expenses.value[index].summ
    editedComment.value = expenses.value[index].comment
    currentRowData.value = expenses.value[index]
}

const handleAddClick = (index) => {
    editFormVisible.value = true
    editedSumm.value = ''
    editedComment.value = ''
}
const handleDelete = (index) => {
    currentRow.value = index
    Api(
        {
            url: '/' + expenses.value[currentRow.value].uuid,
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json;charset=utf-8',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            action: function () {
                editFormVisible.value = false
                currentRow.value = false;
                refreshExpenses()

                ElNotification({
                    title: 'Success',
                    message: 'Expense Deleted',
                    type: 'success',
                })
            }
        }
    )
}

const refreshExpenses = () => {
    Api(
        {
            url: '',
            method: 'GET',
            action:
                response => response.json().then((data) => {
                    expenses.value = data.data
                    links.value = data.links
                    dataLoaded.value = true
                })
        }
    )
}

const updateOrAdd = () => {
    if (currentRow.value !== false) {
        Api(
            {
                url: '/' + expenses.value[currentRow.value].uuid,
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({summ: editedSumm.value, comment: editedComment.value, _method: 'PUT'}),
                action: function () {
                    editFormVisible.value = false
                    currentRow.value = false;
                    refreshExpenses()
                    ElNotification({
                        title: 'Success',
                        message: 'Expense updated',
                        type: 'success',
                    })

                }
            }
        )
    } else {
        Api(
            {
                url: '',
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({summ: editedSumm.value, comment: editedComment.value}),
                action: function (response) {
                    editFormVisible.value = false
                    refreshExpenses()
                    ElNotification({
                        title: 'Success',
                        message: 'Expense created   ',
                        type: 'success',
                    })
                }
            }
        )
    }

}
refreshExpenses();
</script>

<template>
    <el-row class="mb-10" v-if="dataLoaded">

        <el-button type="success" @click="handleAddClick">
            <el-icon>
                <Plus/>
            </el-icon>
        </el-button>
        <el-table :data="expenses" stripe style="width: 100%">
            <el-table-column prop="id" label="ID" width="50"/>
            <el-table-column prop="summ" label="Summ" width="100"/>
            <el-table-column prop="comment" label="Comment" width=""/>
            <el-table-column label="Operations">
                <template #default="scope">

                    <el-button size="small" @click="handleEditClick(scope.$index)">
                        <el-icon :size="24">
                            <Edit/>
                        </el-icon>
                    </el-button>
                    <el-button size="small" @click="handleDelete(scope.$index)">
                        <el-icon :size="24">
                            <Delete/>
                        </el-icon>
                    </el-button>
                </template>
            </el-table-column>

        </el-table>
    </el-row>


    <!--    edit dialog-->
    <el-dialog
        v-model="editFormVisible"
        title="Edit Expense"
        width="30%">

        <el-card :body-style="{ padding: '0px' }">
            <div style="padding: 14px">

                <el-form :model="form" label-width="120px">
                    <el-form-item label="Summ">
                        <el-input v-model="editedSumm"/>
                    </el-form-item>
                    <el-form-item label="Comment">
                        <el-input v-model="editedComment" type="textarea" rows="7"/>
                    </el-form-item>
                </el-form>
                <div class="bottom">
                    <el-button text class="button">{{}}</el-button>
                </div>
            </div>
        </el-card>

        <template #footer>
          <span class="dialog-footer">
            <el-button @click="updateOrAdd">Save</el-button>
          </span>
            <span class="dialog-footer">
            <el-button @click="editFormVisible = false">Cancel</el-button>
          </span>
        </template>
    </el-dialog>
</template>

