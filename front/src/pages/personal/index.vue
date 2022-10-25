<template>
  <div class="">
    <div class="personal-content">
      <!-- 個人資料-背景 -->
      <div class="container-fluid">
        <div class="row">
          <div class="personal-bg"></div>
        </div>
        
      </div>
      
      <!-- 個人資料-頭像 / 資料 -->
      <div class="container">
        <div class="row">
          <div class="col-12">

            <div class="personal-page-content-1">
              <!-- 頭像 -->
              <div class="avatar-wrap mb-32">
                <div class="avatar">
                  <img-upload
                      ref="uploadRef"
                      :show-icon="false"
                      v-model:imageUrl="avatar"
                      
                      :can-clip="false"
                      accept=".png"
                  >
                  </img-upload>
                </div>
              </div>
              <div class="personal-info-text-content pb-40">
                <!-- 使用者名稱 -->
                <div class="heading-B-2">使用者自訂名稱</div>
                <!-- setting icon -->
                <el-icon class="ml-auto">
                  <Setting/>
                </el-icon>
              </div>
            </div>
            
          </div>
        </div>
      </div>

      <!-- 個人資料-資料修改 -->
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-8 col-md-10 col-12">
            <div class="">
              <form>
                <ul class="form-list mt-64">
                  <li class="form-item mb-24">
                    <label class="body-B-1 mb-4" for="user-name">使用者名稱</label>
                    <input v-model="formModel.name" placeholder="請輸入使用者名稱" autocomplete="off" size="large" type="text" id="user-name"/>
                  </li>
    
                  <li label="E-mail" prop="email" class="form-item mb-48">
                    <label class="body-B-1 mb-4" for="user-email">電子信箱</label>
                    <input v-model="formModel.email" placeholder="請輸入電子信箱" autocomplete="off" size="large" type="text" id="user-email"/>
                  </li>


                  <li label="錢包地址" class="mb-72">
                    <label class="body-B-1 mb-4">錢包地址</label>
                    <div class="wallet-address">

                      <p class="body-B-1 clamp-1">0x2d775455skkcoa54d7ad5fwok454cd</p>
                      
                      <el-icon class="ml-auto">
                        <CopyDocument/>
                      </el-icon>
                    </div>
                  </li>

                  <li class="">
                    <button class="btn btn-large" type="button" @click="submitForm()">儲存</button>
                  </li>

                </ul>
  
                
              </form>
            </div>
          </div>
        </div>
      </div>
      
      



      <el-dialog v-model="showDialog">
        <img-upload
            ref="uploadRef"
            v-model:imageUrl="fileList"
            :can-clip="false"
            accept=".png"
        ></img-upload>
      </el-dialog>

    </div>
  </div>

</template>

<script lang="ts" setup>
import {reactive, ref} from 'vue'
import type {FormInstance} from 'element-plus'
import {ImgUpload} from '@components/upload/index'
import userApi from '@/api/user'
import defaultAvatar from './man.png'
import {ElMessage} from "element-plus";

const ruleFormRef = ref<FormInstance>()
const uploadRef = ref<any>()
const fileList = ref<''>('')
const showDialog = ref<boolean>(false)
const formModel = reactive({
  email: '',
  name: '',
  img: ''
})
const avatar = computed(() => {
  return formModel.img || defaultAvatar
})
const validateEmil = (rule: any, value: any, callback: any) => {
  if (!value) {
    return callback(new Error('请输入邮箱'))
  }
  const regularEmail = /^[A-Za-z0-9-_\u4e00-\u9fa5]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/
  if (!regularEmail.test(value)) {
    return callback(new Error('请输入合法的邮箱'))
  }
  callback()
}
const validateName = (rule: any, value: any, callback: any) => {
  if (!value) {
    return callback(new Error('请输入使用者名稱'))
  }
  callback()
}
const rules = reactive({
  email: [{required: true, validator: validateEmil, trigger: 'blur'}],
  userName: [{required: true, validator: validateName, trigger: 'blur'}],
})

const submitForm = async () => {
  if (!ruleFormRef.value) return;
  const valid = await ruleFormRef.value.validate()
  if (!valid) return;
  const params = {...formModel}
  try {
    const {status} = await userApi.updatePersonal(params)
    if (status === 'ok') {
      ElMessage.success("保存成功")
    }
  } catch (e) {
    ElMessage.error("保存失败")
  }
}

</script>

<style  lang="less">
  .wallet-address {
    display: flex;
    align-items: center;
    gap:16px;
    width: 100%;
    height: 56px;
    padding: 16px 18px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    .el-icon {
      flex-shrink: 0;
      width: 18px;
      height: 24px;
      svg {
        width: 100%;
      }
    }
  }
</style>