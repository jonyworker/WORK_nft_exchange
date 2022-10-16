<template>
  <el-upload
    v-bind="$attrs"
    ref="upload"
    v-model:file-list="fileList"
    class="upload-demo"
    :action="props.uploadApi"
    :on-success="onSuccess"
    :on-change="onChange"
    drag
  >
    <el-icon class="el-icon--upload">
      <upload-filled />
    </el-icon>
    <div class="el-upload__text">拖拽或者 <em>点击上传</em></div>
    <template #tip>
      <slot name="tips" />
    </template>
  </el-upload>
</template>

<script setup lang="ts">
  import { ACCEPT_FILE_TYPE } from '@/components/upload/types';
  import { commonApi } from '@/api/commentApi';
  import { ElMessage } from 'element-plus';
  import { UploadFilled } from '@element-plus/icons-vue';
  import type { UploadProps, UploadUserFile, UploadFile, UploadFiles, UploadInstance } from 'element-plus';
  import { ref, defineEmits, watchEffect } from 'vue';

  interface FileUploadProps extends UploadProps {
    uploadApi?: string;
    list?: [];
  }

  const fileList = ref<UploadUserFile[]>([]);
  const emit = defineEmits(['update:list', 'success']);
  const upload = ref<UploadInstance>();

  const props = withDefaults(defineProps<FileUploadProps>(), {
    uploadApi: commonApi.uploadFile,
    list: () => [],
    accept: ACCEPT_FILE_TYPE.IMG,
    multiple: false,
    uniform: false,
    disabled: false,
  });
  watchEffect(() => {
    fileList.value = props.list;
  });

  const onSuccess: UploadProps['onSuccess'] = (response: any, uploadFile: UploadFile, uploadFiles: UploadFiles) => {
    emit('update:list', uploadFiles);
    emit('success', response);
  };

  const submitUpload = async () => {
    if (!fileList.value?.length) {
      return ElMessage.error('请先上传文件');
    }
    await upload.value!.submit();
  };

  defineExpose({ submitUpload });
</script>
