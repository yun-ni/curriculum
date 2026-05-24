<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
            border-top: 3px double #000;
            border-bottom: 3px double #000;
            padding: 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        th {
            background-color: #eeeeee;
            text-align: left;
            font-weight: normal;
        }

        .date {
            width: 13%;
        }

        .hospital {
            width: 22%;
        }

        .content {
            width: 32%;
        }

        .memo {
            width: 33%;
        }

        .row-height {
            height: 55px;
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