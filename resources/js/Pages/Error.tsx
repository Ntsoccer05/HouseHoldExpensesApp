export default function ErrorPage({ status }) {
    const title = {
        503: "503: Service Unavailable",
        500: "500: Server Error",
        404: "404: Page Not Found",
        403: "403: Forbidden",
    }[status];

    const description = {
        503: "申し訳ございませんが、現在メンテナンス中です。しばらくお待ちください。",
        500: "サーバーに異常が発生しました。",
        404: "お探しのページは見つかりませんでした。",
        403: "このページへのアクセスは禁止されています。",
    }[status];

    return (
        <div>
            <h1>{title}</h1>
            <div>{description}</div>
        </div>
    );
}
