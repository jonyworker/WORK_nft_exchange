<template>
  <el-upload
      ref="upload"
      v-model:file-list="files"
      :list-type="multiple ? 'picture-card' : 'picture'"
      class="uploader"
      :action="action"
      :multiple="multiple"
      :accept="accept"
      :on-preview="handlePictureCardPreview"
      :before-upload="handlerCheck"
      :on-error="handleError"
      :on-success="handleSuccess"
      :[limitKey]="limit"
      :show-file-list="multiple"
      :disabled="disabled"
      v-bind="otherAttr"
      :headers="props.headers"
  >
    <img v-if="!multiple && imageUrl" :src="imageUrl" class="uploader__img" />
    <el-icon v-if="props.showIcon">
      <UploadFilled/>
    </el-icon>
  </el-upload>
  <!-- 预览弹窗 -->
  <el-dialog v-model="dialogVisible">
    <div class="preview">
      <img class="w-full" :src="dialogImageUrl"/>
    </div>
  </el-dialog>
  <!-- 图片裁剪 -->
  <img-crop v-if="canClip" ref="imgCrop" v-model:visible="clipVisible" :img="preImage" @save="handleClip"></img-crop>
</template>

<script lang="ts" setup>
import {ref, computed, defineExpose, defineEmits, reactive, useAttrs, watch} from 'vue';
import axios, {AxiosRequestHeaders} from 'axios';
import {ElUpload, ElDialog, ElMessage} from 'element-plus';
import {commonApi} from '@/api/commentApi';
import {ACCEPT_FILE_TYPE} from '../types';
import ImgCrop from '../img-crop.vue';
import type {
  UploadFile,
  UploadUserFile,
  UploadProps,
  UploadRawFile,
  UploadInstance,
  UploadRequestOptions,
} from 'element-plus';


interface ImgUploadProps {
  /**
   * 文件列表，v-model直接绑定
   */
  list?: UploadUserFile[];
  /**
   *  请求 URL
   */
  action?: string;
  /**
   * 接受上传的文件类型（thumbnail-mode 模式下此参数无效）
   */
  accept?: string;
  /**
   * 允许上传文件的最大数量,需要与允许多选配合
   */
  limit?: number;
  /**
   * 是否多选
   */
  multiple?: boolean;
  /**
   * 文件大小限制,M为单位,默认2M
   */
  size?: number;
  /**
   * 是否等比限制，即高度和宽度统一
   */
  uniform?: boolean;
  /**
   * 单个文件上传时图片地址
   */
  imageUrl?: string;
  /**
   * 是否可裁剪
   */
  canClip?: boolean;
  /**
   * 是否禁用
   */
  disabled?: boolean;
  /**
   * 是否展示上传Icon
   */
  showIcon?: boolean;

  headers?: {
    'access-token': string;
    [key: string]: any
  }
}

const props = withDefaults(defineProps<ImgUploadProps>(), {
  action: commonApi.uploadImg,
  list: () => [],
  accept: ACCEPT_FILE_TYPE.IMG,
  multiple: false,
  showIcon:true,
  limit: 1,
  size: 2,
  uniform: false,
  imageUrl: '',
  canClip: false,
  disabled: false,
  headers: () => {
    console.log("-> localStorage.getItem('token') ", localStorage.getItem('token') );
    return {"access-token": localStorage.getItem('token') || ''}
  },
});

const dialogImageUrl = ref('');
const dialogVisible = ref(false);
const upload = ref<UploadInstance>();
const imageUrl = ref(props.imageUrl);
const files = ref<UploadUserFile[]>([]);
const emit = defineEmits(['update:list', 'update:imageUrl']);
const attrs = useAttrs();

/**
 * 上传状态
 */
const UPLOAD_STATUS = {
  READY: 'ready',
  UPLOADING: 'uploading',
  SUCCESS: 'success',
  FAIL: 'fail',
};

/**
 * 针对剪辑图片上传
 */
const httpRequest = async (row: UploadRequestOptions) => {
  console.log("-> 2", 2);
  const {action, headers, filename, file} = row;
  const formData = new FormData();
  formData.append(filename, uploadClipFile.value, file.name);
  const {data} = await commonApi.uploadImgAction(formData)
  /* const { data } = await axios({
    url: action,
    data: formData,
    method: 'POST',
    headers: headers as AxiosRequestHeaders,
  }); */
  return data;
};

/**
 * 针对剪辑图片触发change 和 beforeChange事件
 */
const uploadChange = async (file: UploadFile) => {
  console.log("-> 1", 1);
  if (file.status === UPLOAD_STATUS.READY) {
    const url = file.raw;
    const reader = new FileReader();
    reader.onload = (event: any) => {
      preImage.value = event.target.result as string;
    };
    url && reader.readAsDataURL(url);
    clipVisible.value = true;
  }
};

const handlerCheckClip = async () => {
  const currentSize = (uploadClipFile.value?.size ?? 0) / 1024 / 1024;
  if (currentSize > props.size) {
    ElMessage.error(`图片大小不能超过${props.size}M！请重新上传`);
    return false;
  }
  return true;
};

const otherAttr = reactive({
  ...attrs,
  ...(props.canClip && {
    autoUpload: false,
    httpRequest,
    onChange: uploadChange,
    beforeUpload: handlerCheckClip,
  }),
});

const clipVisible = ref(false);
const preImage = ref('');
const uploadClipFile = ref();

const limitKey = computed(() => {
  return props.multiple ? 'limit' : '';
});

const handlePictureCardPreview = (file: UploadFile) => {
  dialogImageUrl.value = file.url!;
  dialogVisible.value = true;
};

const handlerCheck: UploadProps['beforeUpload'] = async rawFile => {
  const curSize = rawFile.size / 1024 / 1024;
  if (curSize > props.size) {
    ElMessage.error(`图片大小不能超过${props.size}M！请重新上传`);
    return false;
  }
  if (props.uniform) {
    const imgData: any = await checkProportion(rawFile);
    if (!imgData?.ifUniform) {
      ElMessage.error(`图片比例需要1:1！当前宽高比:${imgData?.width}:${imgData?.height}`);
      return false;
    }
  }
};

const handleError = () => {
  ElMessage.error(`上传失败`);
};

const handleSuccess: UploadProps['onSuccess'] = response => {
  const {url:data} = response;
  console.log("-> data", data);
  if (!props.multiple) {
    imageUrl.value = data;
    emit('update:imageUrl', data);
  }
  emit('update:list', !props.multiple ? imageUrl.value : files.value);
};

/**
 * 校验图片尺寸是否等比
 */
const checkProportion = (file: UploadRawFile) => {
  return new Promise(resolve => {
    const content = new FileReader();
    content.readAsDataURL(file);
    content.onload = () => {
      const img = new Image();
      img.src = typeof content.result === 'string' ? content.result : '';
      img.onload = () => {
        resolve({
          ifUniform: img.width === img.height,
          width: img.width,
          height: img.height,
        });
      };
    };
  });
};

watch(
    () => props.imageUrl,
    newImageUrl => {
      imageUrl.value = newImageUrl;
    }
);
watch(
    () => props.list,
    val => {
      files.value = val;
    }
);
const handleClip = (val: any) => {
  uploadClipFile.value = val;
  upload.value?.submit();
};

defineExpose({files, imageUrl});
</script>

<style lang="less" scoped>

.uploader {
  display: block;

  &__img {
    width: 190px;
    height: 190px;
    border-radius: 50%;
  }

  &-icon {
    width: 20px;
    height: 20px;
  }

  :deep(.ep-upload) {
    border: 1px dashed var(--wk-color-gray-400);
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    margin: 8px 0;
    width: 98px;
    height: 98px;

    &:hover {
      border-color: var(--wk-color-primary);
    }
  }

  :deep(.ep-upload-list__item) {

    width: 98px;
    height: 98px;
    margin: 8px 8px 8px 0;
  }
}

.preview {
  max-height: 600px;
  overflow-x: hidden;
}
</style>
