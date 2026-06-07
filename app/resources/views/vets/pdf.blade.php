<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <style>
        /* 基本の文字 */
        @font-face {
            font-family: 'NotoSansJP';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path("fonts/Noto_Sans_JP/static/NotoSansJP-Regular.ttf") }}') format('truetype');
        }

        @font-face {
            font-family: 'NotoSansJP';
            font-style: normal;
            font-weight: bold;
            src: url('{{ storage_path("fonts/Noto_Sans_JP/static/NotoSansJP-Bold.ttf") }}') format('truetype');
        }
        /* 全てのHTML要素に適用 */
        body, table, th, td {
            font-family: 'NotoSansJP', sans-serif;
            font-size: 12px;
        }
        body {
            padding-top: 5mm;
            width: 190mm;
            height: 297mm;
            margin-left: auto;
            margin-right: auto;
            font-size: 12px;
        }
        .header,
        .footer {
            width: 100%;
            overflow: hidden;
        }

        .left,
        .right {
            width: 48%;
            box-sizing: border-box;
        }

        .left {
            float: left;
        }

        .right {
            float: right;
            text-align: right;
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            text-align: right;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="title">
        通院記録
    </div>

    <table>
        <thead>
            <tr>
                <th class="date">日付</th>
                <th class="hospital">病院名</th>
                <th class="content">内容</th>
                <th class="memo">メモ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visits as $visit)
                <tr class="row-height">
                    <td>{{ $visit->visit_date }}</td>
                    <td>
                        {{ $visit->has_visit === 0 ? $visit->hospital_name : '通院なし' }}
                    </td>
                    <td>
                        症状：{{ $visit->symptom }}<br>
                        投薬：{{ $visit->medication ?? 'なし' }}<br>
                        処方薬：{{ $visit->prescription ?? 'なし' }}
                    </td>
                    <td>
                        {{ $visit->memo }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>