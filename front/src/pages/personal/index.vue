<template>
  <div class="">
    <div class="personal-page">
      <div class="personal-bg">
      </div>
      <div class="personal-page-title">
        <div class="personal-page-content">
          <div class="avatar">
            <img-upload
                ref="uploadRef"
                :show-icon="false"
                v-model:imageUrl="avatar"
                :can-clip="false"
                accept=".png,.jpeg,.jpg"
            >
            </img-upload>
          </div>
          <div class="d-lg-flex align-items-baseline d-flex-column">
            <!-- 使用者名稱 -->
            <div class="heading-B-2 color-white mr-16" >{{userInfo.name}}</div>
            <!-- 錢包地址 -->
            <div class="d-flex align-items-center mt-lg-0 mt-8" @click="copyInfo(userInfo.username)">
              <div class="body-B-1 clamp-single color-white" style="width: 130px;">{{userInfo.username}}</div>
              <div class="ml-8 i-copy bg-alpha-white-55 square-24"></div>
            </div>
          </div>

          <!-- <el-icon class="ml-auto" style="" @click="goto('Personal')">
            <Setting/>
          </el-icon> -->
        </div>
      </div>
      
      <div class="form-wrapper">
        <el-form
            ref="ruleFormRef"
            :model="formModel"
            :rules="rules"
            label-width="120px"
            label-position="top"
        >
          <el-form-item label="使用者名稱" prop="name">
            <el-input v-model="formModel.name" placeholder="請輸入使用者名稱" autocomplete="off" size="large"/>
          </el-form-item>
          <el-form-item label="E-mail" prop="email" class="mt-24">
            <el-input v-model="formModel.email" placeholder="請輸入電子信箱" autocomplete="off" size="large"/>
          </el-form-item>
          <el-form-item label="錢包地址" class="mt-48">
            <div class="wallet-address">
              <div>{{userInfo.username}}</div>
              <!-- <el-icon>
                <CopyDocument/>
              </el-icon> -->
              <div class="ml-8 i-copy bg-alpha-white-55 square-24" @click="copyInfo(userInfo.username)"></div>
            </div>

          </el-form-item>
 
          <el-form-item class="mt-72">
            <el-button  class="" style="width: 100%" type="primary" @click="submitForm()">儲存</el-button>
          </el-form-item>
        </el-form>
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
import { useStore} from "vuex";
import {copy} from "@utils/copy";

const store = useStore();
const ruleFormRef = ref<FormInstance>()
const uploadRef = ref<any>()
const fileList = ref<''>('')
const showDialog = ref<boolean>(false)
const userInfo =ref(store.state.user.loginInfo)
const formModel = reactive({
  email: '',
  name: '',
  img: ''
})
const avatar = ref(formModel.img || defaultAvatar)
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
/**
 * 复制名称
 */
const copyInfo=(info:string)=>{
  copy(info)
}
const submitForm = async () => {
  if (!ruleFormRef.value) return;
  const valid = await ruleFormRef.value.validate()
  if (!valid) return;
  const params = {...formModel,img:avatar.value}
  try {
    const {status} = await userApi.updatePersonal(params)
    if (status === 'OK') {
      ElMessage.success("保存成功")
      const newUserInfo ={...userInfo.value,photo_url:params.img,email:params.email,name:params.name}
      userInfo.value =newUserInfo;
      store.commit('user/updateLoginInfo', newUserInfo)
    }
  } catch (e) {
    ElMessage.error("保存失败")
  }
}
const init =()=>{
  const isLogin = store.state.isLogin;
  if(isLogin){
    const loginInfo = store.state.user.loginInfo;
    formModel.email = loginInfo.email??'';
    formModel.name = loginInfo.name??'';
    avatar.value = loginInfo.photo_url??defaultAvatar;
  }


}

onMounted(init)

</script>

<style scoped lang="less">
  :deep .el-button {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    height: auto;
    white-space: nowrap;
    cursor: pointer;
    color: #FFFFFF;
    text-align: center;
    box-sizing: border-box;
    outline: 0;
    transition: .1s;
    font-family: "Noto Sans TC", sans-serif;
    font-style: normal;
    font-weight: 700;
    font-size: 18px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    vertical-align: middle;
    -webkit-appearance: none;
    background-image: linear-gradient(180deg, #8585FF 0%, #4A4AC4 100%);
    border-radius: 8px;
    padding: 16px 18px;
    background-color: none;
    border: none;
    
  }
  :deep .form-wrapper input[type="text"] {
    font-family: "Noto Sans TC", sans-serif;
    font-style: normal;
    font-weight: 500;
    font-size: 18px;
    padding: 16px 18px;
    border: none;
    margin: 0;
  }
  :deep .el-input__wrapper {
    border-radius: 8px;
  }
  :deep .el-input--large .el-input__wrapper {
    padding: 0;
  }
  :deep .el-input__inner {
    height: auto;
    line-height: auto;
    line-height: 0;
  }


.personal-page {
  display: flex;
  flex-direction: column;
  align-items: center;

  .personal-bg {
    width: 100%;
    height: 364px;
    background: #D9D9D9;
  }
}

.personal-page-title {

  width: 100%;
  max-width: 1290px;
  .personal-page-content {
    padding-top: 63px;
    margin: 0 40px 63px 40px;

    height: 143px;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 700;
    font-size: 36px;
    position: relative;
    display: flex;
    align-items: center;
    border-bottom: 2px solid rgba(255, 255, 255, 0.2);
  }
  .text {
    flex: 1;
  }

  .avatar {
    position: absolute;
    top: -164px;
    width: 190px;
    height: 190px;
    border-radius: 50%;
  }
}

.avatar-img {
  width: 190px;
  height: 190px;
  border-radius: 50%;
}

.wallet-address {
  display: flex;
  box-sizing: content-box;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
  width: 100%;
  height: 56px;
  color: white;
  padding: 0 18px;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 10px;
}

.form-wrapper {
  padding: 0 40px;
  width: 100%;
  max-width: 640px;
}
</style>