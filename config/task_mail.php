<?php

/*
 * =============================================================================
 * 配置文件 - 任务/消息邮件 SMTP（task_mail）
 * =============================================================================
 * 读取：config('task_mail.xxx')，TaskMailService 使用
 * 环境变量段：[TASK_MAIL]，见 .env-example
 * -----------------------------------------------------------------------------
 * enabled   : 总开关，false 时不发任何任务/消息邮件
 * host      : 阿里云 SMTP 服务器 smtpdm-ap-southeast-1.aliyun.com
 * port      : 465 SMTPS
 * username  : SMTP 登录账号（通常为发信地址）
 * password  : SMTP 密码；env 空字符串时用 ?: 默认值，避免误配空密码
 * from_email: 发件人地址，须已验证
 * from_name : 发件人显示名，如 SpeedyRat
 * app_url   : H5 根地址，邮件按钮链接
 * -----------------------------------------------------------------------------
 * env() 键名：task_mail.host / task_mail.password 等（ThinkPHP 自动映射）
 * -----------------------------------------------------------------------------
 * 勿将真实密码提交 Git；生产在服务器 .env 单独配置
 * -----------------------------------------------------------------------------
 * 与 BuildAdmin 后台「系统配置-邮件」无关，本配置专用于业务通知
 * -----------------------------------------------------------------------------
 * 切换发信域：须同步阿里云控制台验证域名与 SMTP 账号
 * -----------------------------------------------------------------------------
 * 测试：分配任务后查 runtime/log 或临时开启 SMTPDebug（仅开发）
 * -----------------------------------------------------------------------------
 * 故障：PASSWORD 未配置 → RuntimeException Task mail SMTP password is not configured
 * -----------------------------------------------------------------------------
 * 示例 .env：
 *   [TASK_MAIL]
 *   ENABLED = true
 *   HOST = smtpdm-ap-southeast-1.aliyun.com
 *   PORT = 465
 *   USERNAME = web@email.sagetaskflow.com
 *   PASSWORD = ****
 *   FROM_EMAIL = web@email.sagetaskflow.com
 *   FROM_NAME = SpeedyRat
 *   APP_URL = https://h5.sagetaskflow.com
 * -----------------------------------------------------------------------------
 * filter_var ENABLED 支持 true/false 字符串解析
 * -----------------------------------------------------------------------------
 * 端口 465 对应 PHPMailer::ENCRYPTION_SMTPS
 * -----------------------------------------------------------------------------
 * 若改用 587 需改 TaskMailService createMailer 为 STARTTLS
 * -----------------------------------------------------------------------------
 * 发信频率：阿里云有日限额，批量全体公告注意限流
 * -----------------------------------------------------------------------------
 * 相关：app/api/service/TaskMailService.php
 * =============================================================================
 */

// 任务分配邮件（阿里云 SMTP）
// env 为空字符串时仍使用下方默认值（避免 .env 里 PASSWORD= 覆盖掉默认密码）
return [
    'enabled'    => filter_var(env('task_mail.enabled', true), FILTER_VALIDATE_BOOLEAN),
    'host'       => env('task_mail.host') ?: 'smtpdm-ap-southeast-1.aliyun.com',
    'port'       => (int)(env('task_mail.port') ?: 465),
    'username'   => env('task_mail.username') ?: 'web@email.sagetaskflow.com',
    'password'   => env('task_mail.password') ?: 'A1b2C3d4e5F6',
    'from_email' => env('task_mail.from_email') ?: 'web@email.sagetaskflow.com',
    'from_name'  => env('task_mail.from_name') ?: 'SpeedyRat',
    'app_url'    => env('task_mail.app_url') ?: 'https://h5.sagetaskflow.com',
];
